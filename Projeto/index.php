<?php
include "Models/header.php";
include "Models/config.php";
require_once "Classes/user.php";




if (isset($_POST["login"])) {
    $user = new User();
    $user->setEmail($_POST["email"]);
    $user->setPassword($_POST["password"]);
    $res = $user->loginUser();

    var_dump($res);
    if ($res) {
        echo "Login efetuado com sucesso";
        $_SESSION["id"] = $user->getUid();
        $_SESSION["nome"] = $user->getNome();
        $_SESSION["role"] = $user->getRole();
        var_dump ($_SESSION);

        if ($_SESSION["role"] == "admin") {
            header("Location: admin.php");
            die();
        }
        if ($_SESSION["role"] == "prof") {
            header("Location: profPage.php");
            die();
        }
        if ($_SESSION["role"] == "student") {
            header("Location: studentPage.php");
            die();
        }
    }  
    
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- Pills navs -->
            <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="tab-login" data-mdb-pill-init href="#pills-login" role="tab"
                        aria-controls="pills-login" aria-selected="true">Login</a>
                </li>
            </ul>
            <!-- Pills navs -->

            <!-- Pills content -->
            <div class="tab-content">
                <!-- Login Panel -->
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <form method="post">
                        <div class="text-center mb-3">
                            <p>Sign in with:</p>
                            <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                                <i class="fab fa-facebook-f"></i>
                            </button>

                            <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                                <i class="fab fa-google"></i>
                            </button>

                            <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                                <i class="fab fa-twitter"></i>
                            </button>

                            <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                                <i class="fab fa-github"></i>
                            </button>
                        </div>

                        <p class="text-center">or:</p>

                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="email" name="email" id="loginName" class="form-control" />
                            <label class="form-label" for="loginName">Email</label>
                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="password" name="password" id="loginPassword" class="form-control" />
                            <label class="form-label" for="loginPassword">Password</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="login" class="btn btn-primary btn-block mb-4">Sign in</button>

                        <!-- Register buttons -->
                        <div class="text-center">
                            <p>Not a member? <a href="regUser.php">Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Pills content -->
        </div>
    </div>
</div>


<?php
include("Models/footer.php");
?>