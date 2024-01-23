<?php
include("Models/header.php");
include("Models/config.php");
require_once __DIR__ . "/Classes/user.php";
if ($_SESSION["role"] != "admin") {
    header("Location: index.php");
    die();
}
//Delete USER
if (isset($_GET["delete"])) {
    $user = new User();
    $user->setUid($_GET["delete"]);
    $user->apagarUser();
}
var_dump($_SESSION);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <h1 class="display-1">Admin Dashboard</h1>

    </div>
</div>
<table class="table align-middle mb-0 bg-white">
    <thead class="bg-light">
        <tr>
            <th>Nome</th>
            <th>Função</th>
            <th>Estado</th>
            <th>Tipo</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $user = new User();
        $container = $user->listarUsers();
        $eot = 0;
        while ($eot == 0) {
            $row = mysqli_fetch_array($container);
            if ($row == null)
                $eot = 1;
            else { ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="https://mdbootstrap.com/img/new/avatars/2.jpg" alt="" style="width: 45px; height: 45px"
                                class="rounded-circle" />
                            <div class="ms-3">
                                <p class="fw-bold mb-1">
                                    <?php echo $row["name"] ?>
                                </p>
                                <p class="text-muted mb-0">
                                    <?php echo $row["email"] ?>
                                </p>
                                <p class="text-muted mb-0">
                                    <?php echo $row["contacto"] ?>
                                </p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="fw-normal mb-1">
                            <?php echo $row["area"] ?>
                        </p>
                        <p class="text-muted mb-0">
                            <?php echo $row["funcao"] ?>
                        </p>
                    </td>
                    <td>
                        <span class="badge badge-success rounded-pill d-inline">
                            <?php echo $row["active"] ?>
                        </span>
                    </td>
                    <td>
                        <?php echo $row["role"] ?>
                    </td>
                    <td>
                        <a href="adminEdit.php?id=<?php echo $row['user_id']; ?>" class="btn btn-warning btn-rounded">Edit</a>
                        <a class="btn btn-danger btn-rounded" href="admin.php?delete=<?php echo $row['user_id']; ?>">Delete</a>
                    </td>
                </tr>
                
                <?php
            }
        } ?>
    </tbody>
</table>
<a href="adminCreate.php" class="btn btn-info btn-rounded mt-2 ms-2" name="Create">Create</a>


<?php include("Models/footer.php"); ?>