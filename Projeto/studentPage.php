<?php
include "Models/header.php";
include "Models/config.php";
require_once "Classes/courses.php";
var_dump($_SESSION);

//Rotina de verificação para apagar curso
if (isset($_GET["enroll"])) {
    $curso = new Curso();
    $curso->setCid($_GET["enroll"]);
    $curso->atribuirCurso();
}
?>

<!--Botões de interação-->
<div class="container mt-5">
    <div class="row justify-content-center">
        <h1 class="display-1">Student Dashboard</h1>
    </div>
</div>
<!--Botões de interação-->

<!--Cartões de cursos-->
<div class="py-5">
    <div class="container">
        <div class="row hidden-md-up">
        <h1 class="display-5">Cursos</h1>
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
                                <a class="btn btn-warning btn-rounded"
                                    href="studentPage.php?enroll=<?php echo $row['id_curso']; ?>">Entrar</a>
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