<?php
 require '../../../functions.php';
 session_start();

 // cek apakah yang mengakses halaman ini sudah login
 if($_SESSION['level']==""){
  header("location:../login.php?pesan=belum_login");
 }

 $faskes = query("SELECT * FROM tb_faskes");

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
            <a class="nav-link" href="jadwal.php">
              <span class="menu-icon">
                <i class="mdi mdi-calendar-multiple-check"></i>
              </span>
              <span class="menu-title">Jadwal Vaksinasi</span>
            </a>
          </li>
          <?php
          if(@$_SESSION['level']=="admin") {?>
          <li class="nav-item menu-items">
            <a class="nav-link" href="../edituser/user.php">
              <span class="menu-icon">
                <i class="mdi mdi-account"></i>
              </span>
              <span class="menu-title">Edit Users</span>
            </a>
          </li>
          <?php } ?>
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
                <a class="nav-link" id="profileDropdown" href="../../index.php" data-toggle="dropdown">
                  <div class="navbar-profile">
                    <img class="img-xs rounded-circle" src="../../assets/images/faces/face15.jpg" alt="">
                    <p class="mb-0 d-none d-sm-block navbar-profile-name"><?php echo $_SESSION['email']; ?></p>
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
            <div class="row">
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Jadwal Vaksinasi</h4>
                    </p>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                        <tr>
                            <th>Nama Puskesmas</th>
                            <th>Tanggal</th>
                            <th>Alamat Puskesmas</th>
                            <th>Kuota</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach( $faskes as $row ) : ?>
                          <tr>
                            <td><?= $row['nama_puskesmas']; ?></td>
                            <td><?= $row['tanggal']; ?></td>
                            <td><?= $row['alamat_puskesmas']; ?></td>
                            <td><?= $row['kuota_faskes']; ?></td>
                            <?php if( $row['status'] == 'Buka') : ?>
                            <td><label class="badge badge-success"><?= $row['status']; ?></label></td>
                            <?php else:?>
                            <td><label class="badge badge-danger"><?= $row['status']; ?></label></td>
                            <?php endif; ?>
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Tabel Penyebaran Wilayah</h4>
                    </p>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Kota</th>
                            <th>Provinsi</th>
                            <th>Status Vaksin</th>
                            <th>Zona</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Serang</td>
                            <td>Banten</td>
                            <td class="text-success"> 67,9% <i class="mdi mdi-arrow-up"></i></td>
                            <td><label class="badge badge-success">ZONA HIJAU</label></td>
                          </tr>
                          <tr>
                            <td>Tanggerang</td>
                            <td>Banten</td>
                            <td class="text-success"> 41.06% <i class="mdi mdi-arrow-up"></i></td>
                            <td><label class="badge badge-success">ZONA HIJAU</label></td>
                          </tr>
                          <tr>
                            <td>Lebak</td>
                            <td>Banten</td>
                            <td class="text-danger"> 35.00% <i class="mdi mdi-arrow-down"></i></td>
                            <td><label class="badge badge-success">ZONA HIJAU</label></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
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