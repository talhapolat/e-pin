<?php
session_start();
ob_start();
require_once("../app/connect.php");
require("class.phpmailer.php");
$ip		      = $_SERVER["REMOTE_ADDR"];
$timeDamga    = time();
$time         = date("Y/m/d", $timeDamga);

$email = $_POST["email"];
$msg = $_POST["msg"];


if (isset($_SESSION["useremail"])) {
  $userQuery = $dbConnect->prepare("SELECT * FROM users WHERE email = ? and statu = 1");
  $userQuery->execute([$_SESSION["useremail"]]);
  $userNum = $userQuery->rowCount();
  $user = $userQuery->fetch(PDO::FETCH_ASSOC);
  if ($userNum == 1) {
  	$user_id = $user["id"];
  }
} else {
	$user_id = 9999;
}



if (isset($email) and isset($msg)) {
	$msgİnsertQuery = $dbConnect->prepare("INSERT INTO messages (user_id, email, message, created_at) values (?,?,?,?)");
	$msgİnsertQuery->execute([$user_id, $email, $msg, $time]);
	$insertControl = $msgİnsertQuery->rowCount();

	if ($insertControl > 0) {

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

$mail->Subject = "Mesajınız Alındı";
$mail->Body =  ' 
<html> 
<head> 
<title>İletişime geçtiğiniz için teşekkürler!</title> 
</head> 
<body> 
<img src="https://chipkolikgame.com/images/icons/logo3s54ds4d3as.png" alt="...">
<h1>İletişime geçtiğiniz için teşekkürler!</h1> 
<table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
<tr style="background-color: #e0e0e0;"> 
<th>Email:</th><td>' . $email . '</td> 
</tr> 
<tr> 
<th>Mesajın:</th><td><p>'. $msg . '</p></td> 
</tr> 
</table> 
</body> 
</html>
'; 


if(!$mail->Send()){
	echo "Mail Error: ".$mail->ErrorInfo;
} else {
	$_SESSION["send"] = "ok";
	header("Location: /contact");
}

} else {
	echo "error reg: 1600848651135";
}

}




?>