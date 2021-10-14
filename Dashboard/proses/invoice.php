<?php
    require('../../functions.php');

    if(isset($_GET['code'])){
        $code = $_GET['code'];
        $sql = "SELECT * FROM tb_pasien where token = '$code'";
        $query = mysqli_query($conn,$sql);
        if(mysqli_num_rows($query) > 0){
            $user = mysqli_fetch_assoc($query);
            $id = $user['id'];
            $sql =  "UPDATE tb_pasien set status=1 where id=$id";
            $query = mysqli_query($conn,$sql);
            if($query){
                echo "</br>Ini Kuota Vaksinasi Kamu, Segera Konfirmasi Ke Faskes Tersebut</br></br>
				";
            }else{
                echo "VERIFIKASI GAGAL ERROR : ".$query;
            }
        }else {
            echo "CODE TIDAK DITEMUKAN ATAU TIDAK VALID";
        }
    }else {
        echo "code ga nih";
    }
	
	$psn = query("SELECT * FROM tb_pasien WHERE id = $id")[0];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<!-- Favicon -->
		<link rel="icon" href="https://www.zilliondesigns.com/images/portfolio/healthcare-hospital/iStock-471629610-Converted.png" type="image/x-icon" />

		<!-- Invoice styling -->
		<style>
			body {
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				text-align: center;
				color: #777;
			}

			body h1 {
				font-weight: 300;
				margin-bottom: 0px;
				padding-bottom: 0px;
				color: #000;
			}

			body h3 {
				font-weight: 300;
				margin-top: 10px;
				margin-bottom: 20px;
				font-style: italic;
				color: #555;
			}

			body a {
				color: #06f;
			}

			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
				border-collapse: collapse;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}
		</style>
	</head>

	<body>

		<div class="invoice-box">
			<table>
				<tr class="top">
					<td colspan="2">
						<table>
							
							<tr>
								<td class="title">
									<img src="https://www.zilliondesigns.com/images/portfolio/healthcare-hospital/iStock-471629610-Converted.png" alt="Company logo" style="width: 100%; max-width: 300px" />
								</td>
								
								<td>
									Tiket Vaksin : <?= $psn['tiket']?><br />
									Program Vaksinasi Pemerintah<br />
									Tanggal : <?= $psn['tanggal']?>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
								<?= $psn['faskes']?><br />
									Block B No.188<br />
									RT 04 RW 11
								</td>
							</tr>
						</table>
					</td>
				</tr>
                
                <tr class="heading">
					<td>Vaksin Pertama</td>

					<td>No Tiket</td>
				</tr>

                <tr class="item">
					<td>Astrazeneka</td>

					<td>#<?= $psn['tiket']?></td>
				</tr>

				<tr class="heading">
					<td>Lokasi</td>

					<td>Jadwal Vaksinasi</td>
				</tr>

				<tr class="details">
					<td>Puskesmas Singandaru Ciracas 42b</td>

					<td><?= $psn['tanggal']?></td>
				</tr>

				<tr class="heading">
					<td>Info</td>

					<td>Petugas</td>
				</tr>

				<tr class="item">
					<td>Segera Ke lokasi untuk mengkonfirmasi tiket anda dan melakukan vaksinasi</td>

					<td>Mamat Escibir</td>
				</tr>
			</table>
		</div>
	</body>
</html>