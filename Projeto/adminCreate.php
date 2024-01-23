<?php
include("Models/header.php");
require_once __DIR__ . "/Classes/user.php";

if (isset($_POST["save"])) {
    $user = new User();
    if (empty($_POST)) {
        echo "Preencha todos os campos";
    } else {
        $user->setNome($_POST["nome"]);
        $user->setEmail($_POST["email"]);
        $user->setPassword($_POST["password"]);
        $user->setArea($_POST["area"]);
        $user->setFuncao($_POST["funcao"]);
        $user->setContacto($_POST["contacto"]);
        $user->setRole($_POST["role"]);
        $user->setActive($_POST["active"]);
        $res = $user->createUser();
        header("Location: admin.php");
    }
}
?>


<div class="container-fluid">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Criar Contacto</h5>
            </div>
            <form method="post">
                <div class="modal-body">
                    <!-- Nome input -->
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome">
                    </div>
                    <!-- Email input -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <!-- Password input -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password*</label>
                        <input type="password" class="form-control" name="password" />
                    </div>
                    <!-- Área input -->
                    <div class="mb-3">
                        <label for="area" class="form-label">Área</label>
                        <input type="text" class="form-control" id="area" name="area">
                    </div>
                    <!-- Função input -->
                    <div class="mb-3">
                        <label for="funcao" class="form-label">Função</label>
                        <input type="text" class="form-control" id="funcao" name="funcao">
                    </div>
                    <!-- Função Role -->
                    <div class="mb-3">
                        <label for="funcao" class="form-label">Tipo de Utilizador</label>
                        <input type="text" class="form-control" id="role" name="role">
                    </div>
                    <!-- Contacto input -->
                    <div class="mb-3">
                        <label for="contacto" class="form-label">Contacto Telefónico</label>
                        <input type="text" class="form-control" id="contacto" name="contacto">
                    </div>
                    <!-- Estado input -->
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="estado" name="active">
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="admin.php" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</a>
                    <button type="submit" class="btn btn-primary" name="save">Criar Contacto</button>
                </div>
                
            </form>
        </div>
    </div>
</div>

<?php
include("Models/footer.php");
?>