<?php
session_start();
if( isset($_SESSION["login"]) ) {
    header("location: Dashboard");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Registrasi - Vaksinasi covid-19</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style-form.css">
</head>
<body>

    <div class="main">

        <!-- Sing in  Form -->
        <form action="Dashboard/cek_login.php" method="post">
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="img/login.jpg" alt="sing up image"></figure>
                        <a href="registrasi.php" class="signup-image-link">Belum Punya Akun ? Ayo Buat</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Masuk</h2>
                        <?php 
	                    if(isset($_GET['pesan'])){
		                if($_GET['pesan'] == "gagal"){
			            echo "<p><i>Email/Password yang kamu masukan salah</i></p></br>";
		                }else if($_GET['pesan'] == "belum_login"){
			            echo "<p><i>Anda harus login untuk mengakses halaman Dashboard!</i><p></br>";
		                }
	                    }
	                    ?>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Email" required="required"/>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password" required="required"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    </form>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>