<?php
try {
	$dbConnect = new PDO("mysql:host=localhost;dbname=talhapol21_chipnew;charset=utf8", "talhapol21_chipnew", "302010905t.");
} catch (PDOException $Hata) {
	echo "Bağlantı Hatası";
	die();
}

$connectQuery	 = $dbConnect->prepare("SELECT * FROM settings LIMIT 1");
$connectQuery->execute();
$settingNum 	 = $connectQuery->rowCount();
$setting 	     = $connectQuery->fetch(PDO::FETCH_ASSOC);

if ($settingNum > 0) {

} else {
	echo "Bağlantı Hatası";
	die();
}


