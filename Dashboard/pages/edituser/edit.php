<?php
session_start();
require '../../../functions.php';
if($_SESSION['level']==""){
  header("location:../../../login.php?pesan=belum_login");
 }
//ambil data di url
$id = $_GET["id"];

// query data pasien berdasarkan id

$psn = query("SELECT * FROM tb_user WHERE id = $id")[0];

//membuat fungsi tombol submit
if ( isset($_POST["signup"]) ) {

    if( ubah($_POST) > 0 ) {
        echo "<script>
            alert('data berhasil di edit !');
            document.location.href = '../edituser/user.php';
            </script>
            ";
    } else {
      "<script>
            alert('data gagal di edit !');
            document.location.href = '../edituser/user.php';
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
                  <h5 class="mb-0 font-weight-normal">Hallo <?php echo $_SESSION['level']; ?> </h5>
                  <!-- <span>Gold Member</span> -->
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
            <a class="nav-link" href="edit.php">
              <span class="menu-icon">
                <i class="mdi mdi-account"></i>
              </span>
              <span class="menu-title">Edit Users</span>
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
                    <p class="mb-0 d-none d-sm-block navbar-profile-name"><?= $_SESSION['email']; ?></p>
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
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="../../index.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Profil</li>
                </ol>
              </nav>
            </div>
            <!-- <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Default Info</h4>
                    <form class="forms-sample">
                      <div class="form-group">
                        <label for="exampleInputUsername1">Username</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputConfirmPassword1">Confirm Password</label>
                        <input type="password" class="form-control" id="exampleInputConfirmPassword1" placeholder="Password">
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <button class="btn btn-dark">Cancel</button>
                    </form>
                  </div>
                </div>
              </div> -->
              <?php
            if(@$_SESSION['level']=="admin"){
          } else { echo "<script>
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
              <?php }?>
              <?php
               if(@$_SESSION['level']=="admin"){
                ?>
              <form method="POST" class="register-form" id="register-form">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <form class="form-sample">
                      <p class="card-description"> Personal info </p>
                      <div class="row">
                        <div class="col-md-6">
                        <form action="" method="post">
                        <input type="hidden" name="id" id='id' class="form-control" value="<?= $psn["id"]; ?>">
                          <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $psn["nama"]; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label for="nik" class="col-sm-3 col-form-label">Nik</label>
                            <div class="col-sm-9">
                            <input type="text" name="nik" id="nik" class="form-control" value="<?= $psn["nik"]; ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label for="telpon" class="col-sm-3 col-form-label">Telpon</label>
                            <div class="col-sm-9">
                            <input type="text" name="telpon" id="telpon" class="form-control" value="<?= $psn["telpon"]; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                              <input type="text" name="email" id="email" class="form-control" value="<?= $psn["email"]; ?>">
                            </div>
                          </div>
                        </div>
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label for="pass" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                              <input type="text" name="pass" id="pass" class="form-control" placeholder="Password Baru">
                            </div>
                          </div>
                        </div>
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                              <input type="text" name="jenis_kelamin" id="jenis_kelamin" class="form-control" value="<?= $psn["jenis_kelamin"]; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                              <input type="text" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?= $psn["tanggal_lahir"]; ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                              <!-- <select class="form-control">
                                <option>Category1</option>
                                <option>Category2</option>
                                <option>Category3</option>
                                <option>Category4</option>
                              </select> -->
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-4">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <!-- <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios1" value="" checked> Free </label> -->
                              </div>
                            </div>
                            <div class="col-sm-5">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <!-- <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios2" value="option2"> Professional </label> -->
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <p class="card-description"> Profil Alamat </p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat 1</label>
                            <div class="col-sm-9">
                            <input type="text" name="alamat" id="alamat" class="form-control" value="<?= $psn["alamat"]; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label for="provinsi" class="col-sm-3 col-form-label">Provinsi</label>
                            <div class="col-sm-9">
                            <input type="text" name="provinsi" id="provinsi" class="form-control" value="<?= $psn["provinsi"]; ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div for="kota" class="form-group row">
                            <label class="col-sm-3 col-form-label">Kota</label>
                            <div class="col-sm-9">
                            <input type="text" name="kota" id="kota" class="form-control" value="<?= $psn["kota"]; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label for="kodepos" class="col-sm-3 col-form-label">Kode Pos</label>
                            <div class="col-sm-9">
                            <input type="text" name="kodepos" id="kodepos" class="form-control" value="<?= $psn["kodepos"]; ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="level" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                        <input type="hidden" name="level" id="level" class="form-control" value="<?= $psn['level']?>">
                        </div>
                      </div>
                        <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="btn btn-outline-success btn-fw" value="Submit"/>
                            </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              </form>
              <?php }?>
              <!-- <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Horizontal Form</h4>
                    <p class="card-description"> Horizontal form layout </p>
                    <form class="forms-sample">
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="exampleInputUsername2" placeholder="Username">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="exampleInputMobile" placeholder="Mobile number">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Re Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" id="exampleInputConfirmPassword2" placeholder="Password">
                        </div>
                      </div>
                      <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input"> Remember me </label>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <button class="btn btn-dark">Cancel</button>
                    </form>
                  </div>
                </div>
              </div> -->
              <!-- <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Inline forms</h4>
                    <p class="card-description"> Use the <code>.form-inline</code> class to display a series of labels, form controls, and buttons on a single horizontal row </p>
                    <form class="form-inline">
                      <label class="sr-only" for="inlineFormInputName2">Name</label>
                      <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Jane Doe">
                      <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
                      <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">@</div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Username">
                      </div>
                      <div class="form-check mx-sm-2">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" checked> Remember me </label>
                      </div>
                      <button type="submit" class="btn btn-primary mb-2">Submit</button>
                    </form>
                  </div>
                </div>
              </div> -->
              <!-- <form method="POST" class="register-form" id="register-form">
              <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama Depan</label>
                            <div class="col-sm-9">
                              <input type="text" name="nama" id="nama" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama Belakang</label>
                            <div class="col-sm-9">
                              <input type="text" name="belakang" id="belakang" class="form-control" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label for="jeniskelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                            <input type="text" name="jeniskelamin" id="jeniskelamin" class="form-control"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label for="date" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                            <input type="text" name="date" id="date" class="form-control" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <p class="card-description"> Info Lengkap </p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                            <input type="text" name="alamat" id="alamat" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label for="provinsi" class="col-sm-3 col-form-label">Provinsi</label>
                            <div class="col-sm-9">
                              <input type="text" name="provinsi" id="provinsi" class="form-control" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label for="kodepos" class="col-sm-3 col-form-label">Kode Pos</label>
                            <div class="col-sm-9">
                              <input type="text" name="kodepos" id="kodepos" class="form-control" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label for="kota" class="col-sm-3 col-form-label">Kota</label>
                            <div class="col-sm-9">
                              <input type="text" name="kota" id="kota" class="form-control" />
                            </div>
                          </div>
                        </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                         -->
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