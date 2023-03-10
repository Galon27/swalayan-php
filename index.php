<?php
error_reporting(0);
session_start();
if ($_SESSION['status'] == "login") {
    header("location:admin.php?page=dashboard");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>TEST</title>
    <link rel="stylesheet" type="text/css" href="style/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div class="left">
            <div class="left-inner">
                <div class="sign-in-form active">
                    <h1>Sign in to Your Project.</h1>

                    <div class="seperator">
                        <span>please log-in here</span>
                    </div>

                    <?php
                    if (isset($_GET['pesan'])) {
                        if ($_GET['pesan'] == "gagal") {
                            echo "
                            <script>
                            </script>
                            ";
                        } else if ($_GET['pesan'] == "logout") {
                            echo "
                            <div class='alert alert-warning' role='alert'>
                                Anda telah berhasil logout
                            </div>
                            ";
                        } else if ($_GET['pesan'] == "belum_login") {
                            echo "
                            <div class='alert alert-success' role='alert'>
                                Anda harus login untuk mengakses halaman admin
                            </div>
                            ";
                        }
                    }
                    ?>

                    <form action="./db_conn/login.php" method="POST">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="input" placeholder="example20" name="username">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" placeholder="*********" name="password">
                        </div>
                        <div class="form-group remember-forgot">
                            <div class="remember">
                                <input type="checkbox" id="yes" name="bydefault" value="yes" class="form-checkbox">
                                <label for="yes">Remember me</label>
                            </div>
                            <div class="forgot">
                                <a href="javascript:;" class="forgot-pass-link">Forgot Password?</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <button id="submit">SIGN IN</button>
                        </div>
                        <div class="create-aacount">
                            Not registered yet? <a href="register.php" class="text-underline sign-up-form-btn"> Create an Account</a>
                        </div>
                    </form>
                </div>


            </div>
            <div class="lottie-player">
                <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_jcikwtux.json" background="transparent" style="width: 700px; height: 700px; position:absolute; top:10%; right:-5px" loop autoplay></lottie-player>

            </div>
        </div>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="position: absolute; top:-1px; right:2px; z-index:-50; width: 2300px;">
        <path fill="#21CECC" fill-opacity="1.1" d="M0,288L48,261.3C96,235,192,181,288,165.3C384,149,480,171,576,160C672,149,768,107,864,80C960,53,1056,43,1152,69.3C1248,96,1344,160,1392,192L1440,224L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
    </svg>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>