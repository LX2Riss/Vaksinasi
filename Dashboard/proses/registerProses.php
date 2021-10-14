<?php
    require ('../../functions.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/OAuth.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/POP3.php';
    require '../PHPMailer/src/SMTP.php';

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $tiket = mt_rand(1000000000, 9999999999);
    $faskes = $_POST['faskes'];
    $tanggal = $_POST['tanggal'];
    $code = md5($email.date('Y-m-d'));

    $sql = "SELECT * FROM tb_pasien where email='$email'";
    $query = mysqli_query($conn,$sql);
    if(mysqli_num_rows($query) > 0){
        echo "<script>
            alert('Kamu Sudah Masuk Dalam Antrian Vaksin');
            document.location.href = '../../admin';
            </script>
            ";
    }else {
        $sql = "INSERT INTO tb_pasien (nama,email,tiket,faskes,tanggal,token)VALUES('$nama','$email','$tiket','$faskes','$tanggal','$code')";
        $query = mysqli_query($conn,$sql);

        //Create a new PHPMailer instance
        $mail = new PHPMailer;

        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
        // SMTP::DEBUG_OFF = off (for production use)
        // SMTP::DEBUG_CLIENT = client messages
        // SMTP::DEBUG_SERVER = client and server messages
        $mail->SMTPDebug = SMTP::DEBUG_OFF;

        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

        //Set the encryption mechanism to use - STARTTLS or SMTPS
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = 'vaksinasismtpcovid@gmail.com';

        //Password to use for SMTP authentication
        $mail->Password = 'Dewa1994@@';

        //Set who the message is to be sent from
        $mail->setFrom('vaksinasismtpcovid@gmail.com', 'Tiket Vaksin :');

        //Set an alternative reply-to address
        //$mail->addReplyTo('replyto@example.com', 'First Last');

        //Set who the message is to be sent to
        $mail->addAddress($email, $nama);

        //Set the subject line
        $mail->Subject = 'Konfirmasi Tiket - Program Vaksinasi Covid-19';

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        // $body = "Hi, ".$nama."<br> : <br> http://localhost/php/verifemail/proses/confirmEmail.php?code=".$code;
        // $mail->msgHTML(file_get_contents('invoice.php'), __DIR__);
        $body = "Terimakasih Sudah Mendaftar, ".$nama."<br>Silahkan Konfirmasi Untuk Mendapatkan Tiket Vaksinasi : <br> http://localhost/laporan/dashboard/proses/invoice.php?code=".$code;
        $mail->Body = $body;
        //Replace the plain text body with one created manually
        $mail->AltBody = 'Konfirmasi Tiket';

        //send the message, check for errors
        if (!$mail->send()) {
            echo 'Mailer Error: '. $mail->ErrorInfo;
        } else {
            echo "<script>
            alert('Registrasi Sukses, Silahkan Cek Email!!');
            document.location.href = '../pages/tables/basic-table.php';
            </script>
            ";
            //Section 2: IMAP
            //Uncomment these to save your message in the 'Sent Mail' folder.
            #if (save_mail($mail)) {
            #    echo "Message saved!";
            #}
        }

    }





?>