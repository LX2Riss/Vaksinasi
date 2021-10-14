<?php
 session_start();
 require '../../../functions.php';
 
 // cek apakah yang mengakses halaman ini sudah login
 if($_SESSION['level']==""){
  header("location:../login.php?pesan=belum_login");
 }


 //pagination atau membuat halaman crud
$jumlahDataPerHalaman = 10;
$jumlahData = count(query("SELECT * FROM tb_user"));
$jumlahtampilan = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["page"])) ? $_GET["page"] : 1;
$awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;

$pasien = query("SELECT * FROM tb_user LIMIT $awalData, $jumlahDataPerHalaman");

if ( isset($_POST["signup"])) {

  if( tambah($_POST) > 0) {
      echo "<script>
          alert('User Baru Berhasil di tambah !');
          document.location.href = 'crud.php';
          </script>
          ";
  } else{
    echo "<script>
    alert('Data User gagal di tambah!');
    document.location.href = 'crud.php';
    </script>
    ";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo" href="../../index.html"><img src="../../assets/images/logo.svg" alt="logo" /></a>
          <a class="sidebar-brand brand-logo-mini" href="../../index.html"><img src="../../assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="../../assets/images/faces/face15.jpg" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal">Hallo <?php echo $_SESSION['level']; ?></h5>
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="../profil/profil.php" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-settings text-primary"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="../profil/profil.php" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-onepassword  text-info"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-calendar-today text-success"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                  </div>
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Menu</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="../../index.php">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="../jadwal/jadwal.php">
              <span class="menu-icon">
                <i class="mdi mdi-calendar-multiple-check"></i>
              </span>
              <span class="menu-title">Jadwal Vaksinasi</span>
            </a>
          </li>
          <?php
          if(@$_SESSION['level']=="admin") {?>
          <li class="nav-item menu-items">
            <a class="nav-link" href="user.php">
              <span class="menu-icon">
                <i class="mdi mdi-account"></i>
              </span>
              <span class="menu-title">Edit Users</span>
            </a>
          </li>
          <?php }?>
          <?php
          if(@$_SESSION['level']=="dokter") {?>
          <li class="nav-item menu-items">
            <a class="nav-link" href="../editfaskes/faskes.php">
              <span class="menu-icon">
                <i class="mdi mdi-hospital-building"></i>
              </span>
              <span class="menu-title">Edit Faskes</span>
            </a>
          </li>
          <?php } ?>
          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <span class="menu-icon">
                <i class="mdi mdi-security"></i>
              </span>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="../profil/profil.php"> Settings </a></li>
                <li class="nav-item"> <a class="nav-link" href="../../logout.php"> Log out </a></li>
              </ul>
            </div>
          </li>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="../../assets/images/logo-mini.svg" alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown d-none d-lg-block">
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="createbuttonDropdown">
                  <h6 class="p-3 mb-0">Projects</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-file-outline text-primary"></i>
                      </div>
                    </div>
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                  <div class="navbar-profile">
                    <img class="img-xs rounded-circle" src="../../assets/images/faces/face15.jpg" alt="">
                    <p class="mb-0 d-none d-sm-block navbar-profile-name"><?php echo $_SESSION['email']; ?></p>
                    <!-- <i class="mdi mdi-menu-down d-none d-sm-block"></i> -->
                  </div>
                </a>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="../../index.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Jadwal</li>
                </ol>
              </nav>
            </div>
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Data Pasien</h4>
                    <div class="table-responsive">
                      <table class="table table-dark">
                        <thead>
                          <tr>
                            <th>[ No ]</th>
                            <th>[ Nama ]</th>
                            <th>[ Nik ]</th>
                            <th>[ Noh Handphone ]</th>
                            <th>[ Email ]</th>
                            <th>[ Jenis Kelamin ]</th>
                            <th>[ Tanggal Lahir ]</th>
                            <th>[ Alamat ]</th>
                            <th>[ Provinsi ]</th>
                            <th>[ Kota ]</th>
                            <th>[ Kode Pos ]</th>
                            <th>[ Status ]</th>
                            <th>[ Edit ]</th>
                            <th><a href="cetak.php" target="_blank" label class="badge badge-success"><h5 class="mdi mdi-printer"></h5></a></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i = 1; ?>
                          <?php foreach( $pasien as $row ) : ?>
                          <tr>
                            <td> <?= $i; ?></td>
                            <td> <?= $row['nama']; ?> </td>
                            <td> <?= $row['nik']; ?> </td>
                            <td> <?= $row['telpon']; ?> </td>
                            <td> <?= $row['email']; ?> </td>
                            <td> <?= $row['jenis_kelamin']; ?> </td>
                            <td> <?= $row['tanggal_lahir']; ?> </td>
                            <td> <?= $row['alamat']; ?> </td>
                            <td> <?= $row['provinsi']; ?> </td>
                            <td> <?= $row['kota']; ?> </td>
                            <td> <?= $row['kodepos']; ?> </td>
                            <td> <?= $row['level']; ?> </td>
                            <td> 
                            <a href="../edituser/edit.php?id=<?= $row["id"]; ?>">Edit</a> | 
                            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('apakah anda yakin?');">Hapus</a> </td>
                          </tr>
                          <?php $i++; ?>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- navigasi halaman -->
              <br><br>
              <?php if( $halamanAktif > 1) : ?>
                <a href="?page=<?= $halamanAktif - 1; ?>">&laquo;</a>
                <?php endif; ?>

              <?php for($i = 1; $i <= $jumlahDataPerHalaman; $i++ ) : ?>
                <?php if( $i == $halamanAktif ) : ?>
                <a href="?page=<?= $i; ?>" style="font-weight: bold; color: red;"><?= $i; ?></a>
                <?php else :?>
                  <a href="?page=<?= $i; ?>"><?= $i; ?></a>
                  <?php endif; ?>
                <?php endfor; ?>

                <?php if( $halamanAktif < $jumlahDataPerHalaman) : ?>
                <a href="?page=<?= $halamanAktif + 1; ?>">&raquo;</a>
                <?php endif; ?>
          <?php
           if(@$_SESSION['level']=="admin"){
          }else { echo "<script>
            alert('Kamu Tidak memiliki akses ke halaman ini !');
            document.location.href = '../../../admin';
            </script>
            ";
            ?>
         <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit User</h4>
                </div>
                </div>
              </div>
              <?php
          }?>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
  </body>
</html>