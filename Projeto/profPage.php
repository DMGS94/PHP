<?php

include "Models/header.php";
include "Models/config.php";
require_once "Classes/courses.php";


// Rotina de verificação para criação de curso
if (isset($_POST["criar"])) {
    $curso = new Curso();
    $curso->setTitulo($_POST["titulo"]);
    $curso->setDescricao($_POST["descricao"]);
    $curso->setCategoria($_POST["categoria"]);
    $curso->setNivel($_POST["nivel"]);
    $curso->createCurso();
}

//Rotina de verificação para apagar curso
if (isset($_GET["delete"])) {
    $curso = new Curso();
    $curso->setCid($_GET["delete"]);
    $curso->apagarCurso();
}

//Rotina de verificação para editar curso
if (isset($_GET["id"])) {
    $curso = new Curso();
    $op = $curso->get($_GET["id"]);
    ?>
    <script>
        //Método para visualizar modal
        $(document).ready(function () {
            $('#exampleModal1').modal('show');
        });
        //Método para fechar modal quando botão actualizar contacto é clicado
        $(document).ready(function () {
            $('#updateButton').click(function () {
                $('#exampleModal1').modal('hide');
            });
        });

    </script>
    <!-- Modal de edição de curso-->
    <div class="modal" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-mdb-backdrop="true" data-mdb-keyboard="true">
        <div class="modal-dialog  ">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Curso</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Hidden input for course ID -->
                        <input type="hidden" id="courseIdInput" name="id_course" value="<?php $curso->getCid(); ?>">
                        <!-- Categoria e Nivel -->
                        <div class="row mb-4">
                            <div class="col">
                                <div data-mdb-input-init class="form-outline">
                                    <input type="text" id="form6Example1" class="form-control" name="categoria"
                                        value="<?php echo $curso->getCategoria(); ?>" />
                                    <label class="form-label" for="form6Example1">

                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div data-mdb-input-init class="form-outline">
                                    <input type="text" id="form6Example2" class="form-control" name="nivel"
                                        value="<?php echo $curso->getNivel(); ?>" />
                                    <label class="form-label" for="form6Example2">

                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Titulo input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" id="form6Example3" class="form-control" name="titulo"
                                value="<?php echo $curso->getTitulo(); ?>" />
                            <label class="form-label" for="form6Example3">

                            </label>
                        </div>
                        <!-- Descrição input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <textarea class="form-control" id="form6Example7" rows="4"
                                name="descricao"><?php echo $curso->getDescricao(); ?></textarea>
                            <label class="form-label" for="form6Example7">
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                            Fechar
                        </button>
                        <button type="submit" class="btn btn-primary updateButton" data-mdb-dismiss="modal"
                            name="update">Actualizar
                            Curso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal de edição de curso-->
    <?php
}
if (isset($_POST["update"])) {
    $curso->setTitulo($_POST["titulo"]);
    $curso->setDescricao($_POST["descricao"]);
    $curso->setCategoria($_POST["categoria"]);
    $curso->setNivel($_POST["nivel"]);
    $curso->updateCurso();
    header("Location: profUser.php");
}
unset($_GET["id"]);
?>

<!-- Modal de criação de curso-->
<div class="modal top fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-mdb-backdrop="true" data-mdb-keyboard="true">
    <div class="modal-dialog  ">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Curso</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Categoria e Nivel -->
                    <div class="row mb-4">
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <input type="text" id="form6Example1" class="form-control" name="categoria" />
                                <label class="form-label" for="form6Example1">Categoria</label>
                            </div>
                        </div>
                        <div class="col">
                            <div data-mdb-input-init class="form-outline">
                                <input type="text" id="form6Example2" class="form-control" name="nivel" />
                                <label class="form-label" for="form6Example2">Nível</label>
                            </div>
                        </div>
                    </div>
                    <!-- Titulo input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="form6Example3" class="form-control" name="titulo" />
                        <label class="form-label" for="form6Example3">Título</label>
                    </div>
                    <!-- Descrição input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <textarea class="form-control" id="form6Example7" rows="4" name="descricao"></textarea>
                        <label class="form-label" for="form6Example7">Descrição</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                        Fechar
                    </button>
                    <button type="submit" class="btn btn-primary" data-mdb-dismiss="modal" name="criar">Criar
                        Curso</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal de criação de curso-->

<!--Botões de interação-->
<div class="container mt-5">
    <div class="row justify-content-center">
        <h1 class="display-1">Professor Dashboard</h1>
    </div>
    <button type="button" class="btn btn-success" data-mdb-modal-init data-mdb-target="#exampleModal">Criar</button>
</div>
<!--Botões de interação-->

<!--Cartões de cursos-->
<div class="py-5">
    <div class="container">
        <div class="row hidden-md-up">
            <?php
            // Rotina para listar cursos do professor
            $curso = new Curso();
            $container = $curso->listarCurso();
            $eot = 0;
            while ($eot == 0) {
                $row = mysqli_fetch_array($container);
                if ($row == null)
                    $eot = 1;
                else { ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top"
                                alt="Fissure in Sandstone" />
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $row["titulo"] ?>
                                </h5>
                                <p class="card-text">
                                    <?php echo $row["descricao"] ?>
                                </p>
                                <span class="badge badge-success rounded-pill d-inline">
                                    <?php echo $row["categoria"] ?>
                                </span>
                                <span class="badge badge-success rounded-pill d-inline">
                                    <?php echo $row["nivel"] ?>
                                </span>
                            </div>
                            <div class="mb-2">
                                <a class="btn btn-danger btn-rounded"
                                    href="profPage.php?delete=<?php echo $row['id_curso']; ?>">Apagar</a>
                                <a class="btn btn-warning btn-rounded"
                                    href="profPage.php?id=<?php echo $row['id_curso']; ?>">Editar</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            $_GET["id"] = null;
            ?>
        </div>
    </div>
</div>
<!--Cartões de cursos-->

<?php
include("Models/footer.php");
?>