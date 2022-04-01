<?php
try {
	$dbConnect = new PDO("mysql:host=localhost;dbname=epindb;charset=utf8", "root", "");
} catch (PDOException $Hata) {
	echo "Bağlantı Hatası";
	die();
}

$connectQuery	 = $dbConnect->prepare("SELECT * FROM settings LIMIT 1");
$connectQuery->execute();
$settingNum 	 = $connectQuery->rowCount();
$setting 	     = $connectQuery->fetch(PDO::FETCH_ASSOC);

$themeQuery	 = $dbConnect->prepare("SELECT * FROM themesettings LIMIT 1");
$themeQuery->execute();
$themeNum 	 = $themeQuery->rowCount();
$theme 	     = $themeQuery->fetch(PDO::FETCH_ASSOC);


if ($settingNum > 0) {

} else {
	echo "Bağlantı Hatası";
	die();
}


