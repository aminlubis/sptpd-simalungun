<?php 
require_once('PHPMailer/PHPMailerAutoload.php');

class Mailer extends PHPMailer{

	function sendemail($params){

		date_default_timezone_set('Etc/UTC');

    $mail = new PHPMailer;

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                     // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'esptpd.simalungun@gmail.com';                 // SMTP username
    $mail->Password = 'qwerty!@#$%';                           // SMTP password
    //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 25;                                    // TCP port to connect to

    $mail->setFrom('esptpd.simalungun@gmail.com', 'Mailer');
    $mail->addAddress(''.$params['email'].'', 'User');     // Add a recipient

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }


	}

  function set_email_object($params) {
    // base url
    $base_url = 'http://localhost/simalungun/sptpd-simalungun/email-confirmation/';
		$mail = new PHPMailer;
    $mail->AddAddress($params['email']);
		$mail->Subject = 'Registration';
		$mail->Body = "'".$params['body']."'";
		// $mail->Body = 'Hallo, '.$params['nama'].'<br> Terima Kasih anda telah mendaftarkan wajib pajak.<br>Silahkan aktifasi akun anda dibawah ini <br><a href="'.$base_url.'?email='.$params['email'].'&token='.$params['password'].'" target="_blank">Aktifasi Akun</a>';

		$mail->isSMTP();
		$mail->SMTPDebug = 0;
		$mail->Debugoutput = "text/plain";
		$mail->IsHTML(true);
		$mail->Host = "smtp-relay.sendinblue.com";
		$mail->Port = 587;
		$mail->SMTPSecure = "tls";
		$mail->SMTPAuth = true;
		$mail->Username = 'deny.arwinto@gmail.com';
		$mail->Password = 'Wfa90wy5L6IAVsH7';
		$mail->From = "esptpd.simalungun@gmail.com";
		$mail->FromName = "[e-SPTPDP] Kab. Simalungun";
		
    if(!$mail->send()) {
        return false;
    } else {
        return true;
    }
	}


}


?>