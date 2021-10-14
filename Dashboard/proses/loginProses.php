<?php
    require ('../config.php');
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users where email = '$email'";
    $query = mysqli_query($con,$sql);

    if(mysqli_num_rows($query) == 0 ){
        echo "EMAIL TIDAK DITEMUKAN";
    }else {
        $user = mysqli_fetch_assoc($query);
        if(password_verify($password,$user['password'])){
            if($user['is_verified']==1){
                session_start();
                $_SESSION['isLogin'] = true;
                $_SESSION['user'] = $user;
    
                header("location: ../home.php");
            }else {
                echo "VERIF EMAIL DULU GAN !";
            }
        }else {
            echo "PASSWORD SALAH !";
        }
    }
?>