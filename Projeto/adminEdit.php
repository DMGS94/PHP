<?php
// A função ob_start() inicia a captura de saída. Qualquer saída que é enviada para o navegador após essa 
//função ser chamada será capturada, em vez de ser enviada imediatamente. Isso é útil quando você quer 
//modificar ou adicionar aos dados que estão sendo enviados para o navegador. Por exemplo, você pode querer 
//adicionar cabeçalhos HTTP adicionais, ou modificar os dados de saída de alguma forma.
ob_start();
include("Models/config.php");
include("Models/header.php");
require_once __DIR__ . "/Classes/user.php";

if ($_SESSION["role"] != "admin") {
    header("Location: index.php");
    die();
}

$idAVer = $_GET["id"] ?? '';

if ($idAVer != "") {
    $user = new User();
    $op = $user->get($idAVer);

    ?>
    <!-- Modal -->
    <div class="container-fluid">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edição do Contacto</h5>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <!-- Nome input -->
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome"
                                value="<?php echo $user->getNome(); ?>" required>
                        </div>
                        <!-- Email input -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?php echo $user->getEmail(); ?>"required>
                        </div>
                        <!-- Área input -->
                        <div class="mb-3">
                            <label for="area" class="form-label">Área</label>
                            <input type="text" class="form-control" id="area" name="area"
                                value="<?php echo $user->getArea(); ?>">
                        </div>
                        <!-- Função input -->
                        <div class="mb-3">
                            <label for="funcao" class="form-label">Função</label>
                            <input type="text" class="form-control" id="funcao" name="funcao"
                                value="<?php echo $user->getFuncao(); ?>">
                        </div>
                        <!-- Função Role -->
                        <div class="mb-3">
                            <label for="funcao" class="form-label">Tipo</label>
                            <input type="text" class="form-control" id="role" name="role"
                                value="<?php echo $user->getRole(); ?>" required>
                        </div>
                        <!-- Contacto input -->
                        <div class="mb-3">
                            <label for="contacto" class="form-label">Contacto Telefónico</label>
                            <input type="text" class="form-control" id="contacto" name="contacto"
                                value="<?php echo $user->getContacto(); ?>">
                        </div>
                        <!-- Estado input -->
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <input type="text" class="form-control" id="estado" name="active"
                                value="<?php echo $user->getActive(); ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="admin.php" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</a>
                        <button type="submit" class="btn btn-primary" name="save">Salvar alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
}
if (isset($_POST["save"])) {
    $user->setNome($_POST['nome']);
    $user->setEmail($_POST["email"]);
    $user->setArea($_POST["area"]);
    $user->setFuncao($_POST["funcao"]);
    $user->setRole($_POST["role"]);
    $user->setContacto($_POST["contacto"]);
    $user->setActive($_POST["active"]);
    $user->updateUser();
    header("Location: admin.php");
}
include("Models/footer.php");
?>