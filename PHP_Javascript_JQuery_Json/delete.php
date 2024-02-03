<?php

session_start();
require_once "pdo.php";

if ( isset($_REQUEST["profile_id"]) ) {
    $stmt = $pdo->query("SELECT * FROM profile WHERE profile_id = " . $_REQUEST["profile_id"]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>8d965c9d</title>
    </head>
    <body>
        <h1>Confirm: Deleting Profile</h1>
        <form action="delete.php" method="post">
            <p>First Name: <?php echo($row["first_name"]) ?></p>
            <p>Last Name: <?php echo($row["last_name"]) ?></p>
            <input type="hidden" name="profile_id" value="<?php echo($_REQUEST["profile_id"]) ?>">
            <input type="submit" name="delete" value="Delete">
            <input type="submit" name="cancel" value="Cancel">
        </form>
    </body>
    </html>
    <?php
} else {
    $_SESSION["error"] = "Missing profile_id";
    header("Location: index.php");
    return;
}

if ( isset($_POST["cancel"]) ) {
    header("Location: index.php");
    return;
}

if ( isset($_POST["delete"]) ) {
    $stmt = $pdo->prepare("DELETE FROM profile WHERE profile_id = :pid");
    $stmt->execute(array(':pid' => $_REQUEST["profile_id"]));
    $_SESSION["success"] = "Record deleted";
    header("Location: index.php");
    return;
}