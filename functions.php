<?php 


//koneksi ke databes
$conn = mysqli_connect("localhost", "root", "", "db_vaksinasi");

if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

function query($query) {
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while( $row = mysqli_fetch_assoc($result) ) {
  $rows[] = $row;
  }
  return $rows;
}


function registrasi($data) {
    global $conn;

    $nama = mysqli_real_escape_string($conn, $data["name"]);
    $nik = mysqli_real_escape_string($conn, $data["nik"]);
    $telpon = mysqli_real_escape_string($conn, $data["telpon"]);
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($conn, $data["pass"]);
    $password2 = mysqli_real_escape_string($conn, $data["re_pass"]);
    $jenis_kelamin = mysqli_real_escape_string($conn, $data["jenis_kelamin"]);
    $tanggal_lahir = mysqli_real_escape_string($conn, $data["tanggal_lahir"]);
    $alamat = mysqli_real_escape_string($conn, $data["alamat"]);
    $provinsi = mysqli_real_escape_string($conn, $data["provinsi"]);
    $kota = mysqli_real_escape_string($conn, $data["kota"]);
    $kodepos = mysqli_real_escape_string($conn, $data["kodepos"]);

    //membuat erorr jika tabel tidak di isi
    if(empty($nama) || empty($nik) || empty($telpon) || empty($email) || empty($password) || empty($password2) || empty($jenis_kelamin) || empty($tanggal_lahir) || empty($alamat) || empty($provinsi) || empty($kota) || empty($kodepos)){
        echo "<script>
        alert('Form tidak boleh kosong')
      </script>";
        return false;
}


        //validasi email tidak boleh sama! && validasi no telpon tidak boleh sama
        $query_check_email = mysqli_query($conn, "SELECT email FROM tb_user WHERE email ='$email'");
        if ( mysqli_fetch_assoc($query_check_email)){
            echo "<script>
                    alert('Email sudah terdaftar!')
                  </script>";
                    return false;
        }
        $query_check_telpon = mysqli_query($conn, "SELECT telpon FROM tb_user WHERE telpon ='$telpon'");
        if ( mysqli_fetch_assoc($query_check_telpon)){
            echo "<script>
                    alert('Nomor telpon sudah terdaftar!')
                  </script>";
                    return false;
        }
        $query_check_telpon = mysqli_query($conn, "SELECT telpon FROM tb_user WHERE nik ='$nik'");
        if ( mysqli_fetch_assoc($query_check_telpon)){
            echo "<script>
                    alert('Nik telpon sudah terdaftar!')
                  </script>";
                    return false;
        }

    // membuat validasi
    if( $password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai!')
              </script>";
              return false;
    }

    // enkripsi password
    $password = sha1($_POST['pass']);

    // untuk menginsert data pendaftar ke databes
    mysqli_query($conn, "INSERT INTO tb_user VALUES('', '$nama', '$nik', '$telpon', '$email', '$password', '$jenis_kelamin', '$tanggal_lahir', '$alamat', '$provinsi', '$kota', '$kodepos', 'pasien')");
    
    return mysqli_affected_rows($conn);

}

function hapus($id) {
  global $conn;
  mysqli_query($conn, "DELETE FROM tb_user WHERE id = $id");
  return mysqli_affected_rows($conn);
}

function tambah($data) {
  global $conn;
  $nama = htmlspecialchars($data["nama"]);
  $nik = htmlspecialchars($data["nik"]);
  $telpon = htmlspecialchars($data["telpon"]);
  $email = htmlspecialchars($data["email"]);
  $password = htmlspecialchars($data["pass"]);
  $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
  $tanggal_lahir = htmlspecialchars($data["tanggal_lahir"]);
  $alamat = htmlspecialchars($data["alamat"]);
  $provinsi = htmlspecialchars($data["provinsi"]);
  $kota = htmlspecialchars($data["kota"]);
  $kodepos = htmlspecialchars($data["kodepos"]);
  $level = htmlspecialchars($data["level"]);

  $query_check_email = mysqli_query($conn, "SELECT email FROM tb_user WHERE email ='$email'");
  if ( mysqli_fetch_assoc($query_check_email)){
      echo "<script>
              alert('Email sudah terdaftar!')
            </script>";
              return false;
  }
  $query_check_telpon = mysqli_query($conn, "SELECT telpon FROM tb_user WHERE telpon ='$telpon'");
        if ( mysqli_fetch_assoc($query_check_telpon)){
            echo "<script>
                    alert('Nomor telpon sudah terdaftar!')
                  </script>";
                    return false;
        }
        $query_check_telpon = mysqli_query($conn, "SELECT telpon FROM tb_user WHERE nik ='$nik'");
        if ( mysqli_fetch_assoc($query_check_telpon)){
            echo "<script>
                    alert('Nik telpon sudah terdaftar!')
                  </script>";
                    return false;
        }

  $password = sha1($_POST['pass']);

  $query = "INSERT INTO tb_user VALUES('', '$nama', '$nik', '$telpon', '$email', '$password', '$jenis_kelamin', '$tanggal_lahir', '$alamat', '$provinsi', '$kota', '$kodepos', '$level')";

            mysqli_query($conn, $query);
            return mysqli_affected_rows($conn);
}

function ubah($data) {
  global $conn;
  $id = $data["id"];
  $nama = htmlspecialchars($data["nama"]);
  $nik = htmlspecialchars($data["nik"]);
  $telpon = htmlspecialchars($data["telpon"]);
  $email = htmlspecialchars($data["email"]);
  $password = htmlspecialchars($data["pass"]);
  $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
  $tanggal_lahir = htmlspecialchars($data["tanggal_lahir"]);
  $alamat = htmlspecialchars($data["alamat"]);
  $provinsi = htmlspecialchars($data["provinsi"]);
  $kota = htmlspecialchars($data["kota"]);
  $kodepos = htmlspecialchars($data["kodepos"]);
  $level = htmlspecialchars($data["level"]);

  $password = sha1($_POST['pass']);

  $query = "UPDATE tb_user SET 
            nama = '$nama', 
            nik = '$nik', 
            telpon = '$telpon',
            email = '$email',
            password = '$password',
            jenis_kelamin = '$jenis_kelamin',
            tanggal_lahir = '$tanggal_lahir',
            alamat = '$alamat',
            provinsi = '$provinsi',
            kota = '$kota',
            kodepos = '$kodepos',
            level = '$level'
            WHERE id = $id
            ";
          
            mysqli_query($conn, $query);
            return mysqli_affected_rows($conn);
}

function ubahfaskes($data) {
  global $conn;
  $id = $data["id"];
  $nama_puskesmas = htmlspecialchars($data["nama_puskesmas"]);
  $tanggal = htmlspecialchars($data["tanggal"]);
  $alamat_puskesmas = htmlspecialchars($data["alamat_puskesmas"]);
  $kuota_faskes = htmlspecialchars($data["kuota_faskes"]);
  $status = htmlspecialchars($data["status"]);

  $query = "UPDATE tb_faskes SET 
            nama_puskesmas = '$nama_puskesmas', 
            tanggal = '$tanggal', 
            alamat_puskesmas = '$alamat_puskesmas',
            kuota_faskes = '$kuota_faskes',
            status = '$status'
            WHERE id = $id
            ";
          
            mysqli_query($conn, $query);
            return mysqli_affected_rows($conn);

}

?>