<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
require '../functions.php';

// menangkap data yang dikirim dari form login
$email = $_POST['email'];
$password = sha1($_POST['password']);


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($conn ,"SELECT * FROM tb_user WHERE email='$email' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if($cek > 0){

	$data = mysqli_fetch_assoc($login);
    
	// cek jika user login sebagai admin
	if($data['level']=="admin"){

		// buat session login dan username
		$_SESSION['email'] = $email;
		$_SESSION['level'] = "admin";
		$_SESSION["login"] = true;
		// alihkan ke halaman dashboard admin
		header("location:index.php");

	// cek jika user login sebagai pasien
	}else if($data['level']=="pasien"){
		// buat session login dan username
		$_SESSION['email'] = $email;
		$_SESSION['level'] = "pasien";
		$_SESSION["login"] = true;
		// alihkan ke halaman dashboard pasien
		header("location:index.php");

	// cek jika user login sebagai dokter
	}else if($data['level']=="dokter"){
		// buat session login dan username
		$_SESSION['email'] = $email;
		$_SESSION['level'] = "dokter";
		$_SESSION["login"] = true;
		// alihkan ke halaman dashboard dokter
		header("location:index.php");

	}else{

		// alihkan ke halaman login kembali
		header("location:../login.php?pesan=gagal");
	}	
}else{
	header("location:../login.php?pesan=gagal");
}

?>