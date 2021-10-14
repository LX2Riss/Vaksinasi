<?php
require '../../../functions.php';
$id = $_GET['id'];

if( hapus($id) > 0) {
    echo "<script>
            alert('Data Berhasil di hapus !');
            document.location.href = 'user.php';
            </script>
            ";
} else {
    echo "<script>
            alert('Data gagal di hapus !');
            document.location.href = 'user.php';
            </script>
            ";
}

?>