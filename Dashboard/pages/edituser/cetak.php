<?php

require_once __DIR__ . '../../../../vendor/autoload.php';
require '../../../functions.php';
$pasien = query("SELECT * FROM tb_user");

$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User</title>
</head>
<body>
    <h1>Daftar User</h1>
    <table border="1" cellpadding="10" cellspacing="0">

        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Nik</th>
            <th>No Handphone</th>
            <th>Email</th>
            <th>Jenis Kelamin</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Provinsi</th>
            <th>Kota</th>
            <th>Kode Pos</th>
        </tr>';

        $i = 1;
        foreach( $pasien as $row ) {
            $html .= '<tr>
                <td>'. $i++ .'</td>
                <td>'. $row["nama"] .'</td>
                <td>'. $row["nik"] .'</td>
                <td>'. $row["telpon"] .'</td>
                <td>'. $row["email"] .'</td>
                <td>'. $row["jenis_kelamin"] .'</td>
                <td>'. $row["tanggal_lahir"] .'</td>
                <td>'. $row["alamat"] .'</td>
                <td>'. $row["provinsi"] .'</td>
                <td>'. $row["kota"] .'</td>
                <td>'. $row["kodepos"] .'</td>
            </tr>';
        }

$html .=    '</table>
</body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output('daftar-user.pdf', 'I');

?>
