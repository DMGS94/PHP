<?php

require_once "pdo.php";
require_once "util.php";

if (isset($_POST["cancel"])) {
    header("Location: index.php");
    return;
}

if (isset($_POST["Save"])) {
    header("Location: index.php");
    return;
}

if (!isset($_REQUEST["profile_id"])) {
    $_SESSION["error"] = "Missing profile_id";
    header("Location: index.php");
    return;
}

$stmt = $pdo->prepare("SELECT * FROM profile WHERE profile_id = :prof AND user_id = :uid");
$stmt->execute(array(":prof" => $_REQUEST["profile_id"], ":uid" => $_SESSION["user_id"]));
$profile = $stmt->fetch(PDO::FETCH_ASSOC);
if ($profile === false) {
    $_SESSION["error"] = "Could not load profile";
    header("Location: index.php");
    return;
}

if (isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["email"]) && isset($_POST["headline"]) && isset($_POST["summary"])) {

    $msg = validateProfile();
    if (is_string($msg)) {
        $_SESSION["error"] = $msg;
        header("Location: edit.php?profile_id=" . $_REQUEST["profile_id"]);
        return;
    }

    // Validate position entries if present
    $msg = validatePos();
    if (is_string($msg)) {
        $_SESSION["error"] = $msg;
        header("Location: edit.php?profile_id=" . $_REQUEST["profile_id"]);
        return;
    }

    $stmt = $pdo->prepare("UPDATE profile SET first_name = :fn, last_name = :ln, email = :em, headline = :he, summary = :su 
                           WHERE profile_id = :pid AND user_id = :uid");
    $stmt->execute(
        array(
            ':pid' => $_REQUEST["profile_id"],
            ':uid' => $_SESSION["user_id"],
            ':fn' => $_POST["first_name"],
            ':ln' => $_POST["last_name"],
            ':em' => $_POST["email"],
            ':he' => $_POST["headline"],
            ':su' => $_POST["summary"]
        )
    );

    // Clear out the old position entries
    $stmt = $pdo->prepare('DELETE FROM position WHERE profile_id = :pid');
    $stmt->execute(array(':pid' => $_REQUEST['profile_id']));

    // Insert the position entries
    insertPosition($pdo, $_REQUEST['profile_id']);

    $stmt = $pdo->prepare('DELETE FROM Education WHERE profile_id=:pid');
    $stmt->execute(array(':pid' => $_REQUEST['profile_id']));

    insertEducation($pdo, $_REQUEST['profile_id']);

    $_SESSION['success'] = 'Profile updated';
    header('Location: index.php');
    return;
}

$profile = loadPro($pdo, $_REQUEST['profile_id']);
$positions = loadPos($pdo, $_REQUEST['profile_id']);
$schools = loadEdu($pdo, $_REQUEST['profile_id']);

//Load up position rows
$stmt = $pdo->prepare("SELECT * FROM Profile where profile_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['profile_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM Position where profile_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['profile_id']));
$rowOfPosition = $stmt->fetchAll();

if ($row === false) {
    $_SESSION['error'] = 'Bad value for user_id';
    header('Location: index.php');
    return;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>David Login Page</title>
    <?php require_once "head.php"; ?>
</head>

<body>
    <div class="container">
        <h1>Editing Profile for UMSI</h1>
        <?php
        if (isset($_SESSION['error'])) {
            echo ('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
            unset($_SESSION['error']);
        }
        ?>
        <form method="post">
            <p>First Name:
                <input type="text" name="first_name" size="60" value="<?php echo $row['first_name'] ?>" />
            </p>
            <p>Last Name:
                <input type="text" name="last_name" size="60" value="<?php echo $row['last_name'] ?>" />
            </p>
            <p>Email:
                <input type="text" name="email" size="30" value="<?php echo $row['email'] ?>" />
            </p>
            <p>Headline:<br />
                <input type="text" name="headline" size="80" value="<?php echo $row['headline'] ?>" />
            </p>
            <p>Summary:<br />
                <textarea name="summary" rows="8" cols="80"><?php echo $row['summary'] ?></textarea>
            <p>
                Position: <input type="submit" id="addPos" value="+">
            <div id="position_fields">
                <?php
                $countEdu = 0;

                echo ('<p>Education: <input type="submit" id="addEdu" value="+">' . "\n");
                echo ('<div id="edu_fields">');
                if (count($schools) > 0) {
                    foreach ($schools as $school) {
                        $countEdu++;
                        echo ('<div id="edu' . $countEdu . '">');
                        echo
                            '<p>Year: <input type="text" name="edu_year' . $countEdu . '" value="' . $school['year'] . '">
<input type="button" value="-" onclick="$(\'#edu' . $countEdu . '\').remove();return false;\"></p>
<p>School: <input type="text" size="80" name="edu_school' . $countEdu . '" class="school" 
value="' . htmlentities($school['name']) . '" />';
                        echo "\n</div>\n";
                    }

                }
                echo "</div></p>\n";

                $countPos = 0;

                echo ('<p>Position: <input type="submit" id="addPos" value="+">' . "\n");
                echo ('<div id="position_fields">');
                if (count($positions) > 0) {
                    foreach ($positions as $position) {
                        $countEdu++;
                        echo ('<div id="position id="position' . $countPos . '">');
                        echo
                            '<br>Year: <input type="text" name="year' . $countPos . '" value="' . htmlentities($position['year']) . '">
<input type="button" value="-" onclick="$(\'#position' . $countPos . '\').remove();return false;"><br>';
                        echo '<textarea name="desc' . $countPos . '"rows="8" cols="80">' . "\n";
                        echo htmlentities($position['description']) . "\n";
                        echo "\n</textarea>\n</div>\n";

                    }

                }
                ?>
            </div>
            <input type="submit" value="Save">
            <input type="submit" name="cancel" value="Cancel">
        </form>
        <script>
            countPos = 0;
            countEdu = 0;

            // http://stackoverflow.com/questions/17650776/add-remove-html-inside-div-using-javascript
            $(document).ready(function () {
                window.console && console.log('Document ready called');

                $('#addPos').click(function (event) {
                    // http://api.jquery.com/event.preventdefault/
                    event.preventDefault();
                    if (countPos >= 9) {
                        alert("Maximum of nine position entries exceeded");
                        return;
                    }
                    countPos++;
                    window.console && console.log("Adding position " + countPos);
                    $('#position_fields').append(
                        '<div id="position' + countPos + '"> \
            <p>Year: <input type="text" name="year' + countPos + '" value="" /> \
            <input type="button" value="-" onclick="$(\'#position' + countPos + '\').remove();return false;"><br>\
            <textarea name="desc' + countPos + '" rows="8" cols="80"></textarea>\
            </div>');
                });

                $('#addEdu').click(function (event) {
                    event.preventDefault();
                    if (countEdu >= 9) {
                        alert("Maximum of nine education entries exceeded");
                        return;
                    }
                    countEdu++;
                    window.console && console.log("Adding education " + countEdu);

                    $('#edu_fields').append(
                        '<div id="edu' + countEdu + '"> \
            <p>Year: <input type="text" name="edu_year' + countEdu + '" value="" /> \
            <input type="button" value="-" onclick="$(\'#edu' + countEdu + '\').remove();return false;"><br>\
            <p>School: <input type="text" size="80" name="edu_school' + countEdu + '" class="school" value="" />\
            </p></div>'
                    );

                    $('.school').autocomplete({
                        source: "school.php"
                    });

                });

            });
        </script>
</body>

</html>