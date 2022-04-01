<?php
session_start();
ob_start();
require_once("../app/connect.php");
require("class.phpmailer.php");
$ip		      = $_SERVER["REMOTE_ADDR"];
$timeDamga    = time();
$time         = date("Y/m/d", $timeDamga);

$email = $_GET["email"];
$p1 = generatePass();
$newpass = md5($p1);

$passQuery = $dbConnect->prepare("UPDATE users SET password = ? WHERE email = ?");
$passQuery->execute([$newpass, $email]);	
$passNum = $passQuery->rowCount();

if ($passNum > 0) {
	$_SESSION["error"] = "Şifreniz yenilendi ve e-posta adresinize gönderildi.";
	header("Location: /mailler/repassmail.php?email=" . $inputemail . "&p1=" . $p1);
} else {
	$_SESSION["error"] = "Şifrenizi yenilerken hata oluştu. Bizimle iletişime geçiniz";
	header("Location: /");
}	

function generatePass($length = 6) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}


$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = $setting["SMTPhost"];
$mail->Port = $setting["SMTPport"]; // or 587
$mail->IsHTML(true);
$mail->SetLanguage("tr", "phpmailer/language");
$mail->CharSet  ="utf-8";

$mail->Username = $setting["SMTPuser"]; // Mail adresi
$mail->Password = $setting["SMTPpass"]; // Parola
$mail->SetFrom($setting["SMTPuser"], "ChipKolik"); // Mail adresi

$mail->AddAddress($email); // Gönderilecek kişi

$mail->Subject = "Şifreniz Yenilendi!";
$mail->Body =  ' 
<html> 
<head> 
<title>Şifreniz Yenilendi!</title> 
</head> 
<body> 
<img src="https://chipkolikgame.com/images/icons/logo3s54ds4d3as.png" alt="...">
<h1>Şifre yenileme talebini siz oluşturmadıysanız bizimle iletişime geçiniz!</h1> 
<table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
<tr style="background-color: #e0e0e0;"> 
<th>Email:</th><td>' . $email . '</td> 
</tr> 
<tr> 
<th>Yeni Şifreniz:</th><td><p>'. $p1 . '</p></td> 
</tr> 
</table> 
</body> 
</html>
'; 


if(!$mail->Send()){
	echo "Mail Error: ".$mail->ErrorInfo;
} else {
	$_SESSION["send"] = "ok";
	header("Location: /");
}



?>