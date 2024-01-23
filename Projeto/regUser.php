<?php
include("Classes/user.php");
include("Models/header.php");

if (isset($_POST["login"])) {
    $user = new User();
    if (empty($_POST["nome"]) || empty($_POST["email"]) || empty($_POST["password"])) {
        echo "Preencha os campos obrigatórios (*)";
    } else {
        $user->setNome($_POST["nome"]);
        $user->setEmail($_POST["email"]);
        $user->setPassword($_POST["password"]);
        $user->setArea($_POST["area"]);
        $user->setFuncao($_POST["funcao"]);
        $user->setContacto($_POST["contacto"]);
        $res = $user->registerUser();
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" class="container-fluid col-6 mb-5">
        <!-- 2 column grid layout with text inputs for the first and last names -->
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" id="form6Example5" class="form-control" name="nome" />
            <label class="form-label" for="form6Example1">Nome*</label>
        </div>
        <!-- Email input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="email" id="form6Example5" class="form-control" name="email" />
            <label class="form-label" for="form6Example5">Email*</label>
        </div>
        <!-- Email input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="password" id="form6Example5" class="form-control" name="password" />
            <label class="form-label" for="form6Example5">Password*</label>
        </div>
        <!-- Text input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" id="form6Example5" class="form-control" name="area" />
            <label class="form-label" for="form6Example1">Area</label>
        </div>

        <!-- Text input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" id="form6Example5" class="form-control" name="funcao" />
            <label class="form-label" for="form6Example1">Função</label>
        </div>
        <!-- Number input -->
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" id="form6Example5" class="form-control" name="contacto" />
            <label class="form-label" for="form6Example1">Telemovel</label>
        </div>

        <!-- Submit button -->
        <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4" name="login">Registar</button>
    </form>
</body>

</html>

<?php include("Models/footer.php"); ?>