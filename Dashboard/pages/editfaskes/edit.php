<?php
session_start();
require '../../../functions.php';
if($_SESSION['level']==""){
  header("location:../../../login.php?pesan=belum_login");
 }
//ambil data di url
$id = $_GET["id"];

// query data pasien berdasarkan id

$psn = query("SELECT * FROM tb_faskes WHERE id = $id")[0];

//membuat fungsi tombol submit
if ( isset($_POST["signup"]) ) {

    if( ubahfaskes($_POST) > 0 ) {
        echo "<script>
            alert('data berhasil di edit !');
            document.location.href = '../editfaskes/faskes.php';
            </script>
            ";
    } else {
      "<script>
            alert('data gagal di edit !');
            document.location.href = '../editfaskes/faskes.php';
            </script>
            ";
    //  echo("Error description: " . $conn -> error);
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
    <link rel="stylesheet" href="../../assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="../../assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
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
                  <!-- <span>Gold Member</span> -->
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="#" class="dropdown-item preview-item">
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
                <a href="#" class="dropdown-item preview-item">
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
            <a class="nav-link" href="pages/edituser/user.php">
              <span class="menu-icon">
                <i class="mdi mdi-account"></i>
              </span>
              <span class="menu-title">Edit Users</span>
            </a>
          </li>
          <?php } ?>
          <li class="nav-item menu-items">
            <a class="nav-link" href="edit.php">
              <span class="menu-icon">
                <i class="mdi mdi-hospital-building"></i>
              </span>
              <span class="menu-title">Edit Faskes</span>
            </a>
          </li>
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
                  </div>
                </a>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Profil </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="../../index.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Profil</li>
                </ol>
              </nav>
          </div>
              <?php
            if(@$_SESSION['level']=="dokter"){
          } else { echo "<script>
            alert('Kamu Tidak memiliki akses ke halaman ini !');
            document.location.href = '../../../Dashboard';
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
              <?php }?>
              <?php
               if(@$_SESSION['level']=="dokter"){
                ?>
              <form method="POST" class="register-form" id="register-form">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"></h4>
                    <form class="forms-sample">
                      <div class="form-group row">
                        <label for="nama_puskesmas" class="col-sm-3 col-form-label">Nama Puskesmas :</label>
                        <div class="col-sm-9">
                        <input type="hidden" name="id" id='id' class="form-control" value="<?= $psn["id"]; ?>">
                          <input type="text" name="nama_puskesmas" id="nama_puskesmas" class="form-control" placeholder="Nama Puskesmas" required="required" value="<?= $psn['nama_puskesmas']?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="tanggal" class="col-sm-3 col-form-label">Tanggal Operasi :</label>
                        <div class="col-sm-9">
                          <input type="date" name="tanggal" id="tanggal" class="form-control" required="required" value="<?= $psn['tanggal']?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="alamat_puskesmas" class="col-sm-3 col-form-label">Alamat :</label>
                        <div class="col-sm-9">
                          <input type="text" name="alamat_puskesmas" id="alamat_puskesmas" class="form-control" placeholder="Alamat Puskesmas" required="required" value="<?= $psn['alamat_puskesmas']?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="kuota_faskes" class="col-sm-3 col-form-label">Kuota Vaksin Harian :</label>
                        <div class="col-sm-9">
                          <input type="number" name="kuota_faskes" id="kuota_faskes" class="form-control" placeholder="Kuota Vaksin Harian" required="required" value="<?= $psn['kuota_faskes']?>">
                        </div>
                      </div>
                      <div class="form-group row">
                      <label for="status" class="col-sm-3 col-form-label">Pilih Status Rumah Sakit :</label>
                      <div class="col-sm-9">
                        <select name="status" id="status" class="form-control">
                        <option>Buka</option>
                        <option>Tutup</option>
                        <option>Sedang Istirahat</option>
                        </select>
                    </div>
                     </div>
                     <br>
                     <br>
                      <input type="submit" name="signup" id="signup" class="btn btn-outline-success btn-fw" value="Update Profil"/>
                    </form>
                  </div>
                </div>
              </div>
              </form>
              <?php }?>
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
    <script src="../../assets/vendors/select2/select2.min.js"></script>
    <script src="../../assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../../assets/js/file-upload.js"></script>
    <script src="../../assets/js/typeahead.js"></script>
    <script src="../../assets/js/select2.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>