<?php  
require_once("../app/connect.php");
session_start();

$ip		      = $_SERVER["REMOTE_ADDR"];
$timeDamga    = time();
$time         = date("Y/m/d", $timeDamga);

$backurl	  = $_SERVER['HTTP_REFERER'];

function Security($var){
	$clearSpace		= trim($var);
	$clearTag       = strip_tags($clearSpace);
	$etkisizyap     = htmlspecialchars($clearTag);
	$result   	    = $etkisizyap;
	return $result;
}

if (array_key_exists('newuser', $_POST)) {

	if (isset($_POST["namesurname"])) {
		$inputname = Security($_POST["namesurname"]);
	} else
	$inputname = "";

	if (isset($_POST["email"])) {
		$inputemail = Security($_POST["email"]);
	} else
	$inputemail = "";

	if (isset($_POST["password"])) {
		$inputpassword = Security($_POST["password"]);
		$md5pass       = md5($inputpassword);
	} else
	$inputpassword = "";

	if (isset($_POST["phone"])) {
		$inputphone = Security($_POST["phone"]);
	} else
	$inputphone = "";

	if (isset($_SESSION["refcode"])) {
		$refcode = $_SESSION["refcode"];
		$refQuery = $dbConnect->prepare("SELECT * FROM users WHERE refcode = ?");
		$refQuery->execute([$refcode]);
		$refNum = $refQuery->rowCount();
		if ($refNum == 1) {
			$refUser = $refQuery->fetch(PDO::FETCH_ASSOC);
			$refUserid = $refUser["id"];
		} else {
			$refUserid = null;
		}
	} else
	$refuser = null;


	$memberQuery = $dbConnect->prepare("SELECT * FROM users WHERE email = ?");
	$memberQuery->execute([$inputemail]);
	$memberNum = $memberQuery->rowCount();

	if ($memberNum > 0) {
		$_SESSION["error"] = "Email adresi kullanılmaktadır.";
		header("Location: /" . $url);
		exit();
	} else {
		$refcode = generateRefCode();

		$memberİnsertQuery = $dbConnect->prepare("INSERT INTO users (name, email, password, phone, statu, refcode, invited_user, created_at) values (?,?,?,?,?,?,?,?)");
		$memberİnsertQuery->execute([$inputname, $inputemail, $md5pass, $inputphone, 1, $refcode, $refUserid, $time]);
		$insertControl = $memberİnsertQuery->rowCount();

		if ($insertControl > 0) {
			$_SESSION["username"] = $inputname;
			$_SESSION["useremail"] = $inputemail;
			$_SESSION["userphone"] = $inputphone;
			header("Location:/");
			exit();
		} else {
			echo "error reg";
		}
	}

}

// USER LOGIN START //

if (array_key_exists('userlogin', $_POST)) {
	
	if (isset($_POST["email"])) {
		$inputemail = Security($_POST["email"]);
	} else
	$inputemail = "";

	if (isset($_POST["password"])) {
		$inputpassword = Security($_POST["password"]);
		$md5pass       = md5($inputpassword);
	} else
	$inputpassword = "";


	$memberQuery = $dbConnect->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
	$memberQuery->execute([$inputemail, $md5pass]);
	$memberNum = $memberQuery->rowCount();
	$user = $memberQuery->fetch(PDO::FETCH_ASSOC);

	if ($memberNum == 0) {
		$_SESSION["error"] = "Email adresi veya şifre hatalı.";
		header('Location: ' . $backurl);
		exit();
	} else {
		if ($user["statu"] == 1 && $user["deleted"] == 0) {
			$_SESSION["username"] = $user["name"];
			$_SESSION["useremail"] = $user["email"];
			$_SESSION["userphone"] = $user["phone"];
			header('Location: ' . $backurl);
		} else {
			echo "Hesabınız askıya alındı. ";
		}

	}


}

// USER LOGIN END //



// UPDATE ACCOUNT INFO //

if (array_key_exists('updateaccountinfo', $_POST)) {

	$name = Security($_POST["nameSurname"]);
	$phone = Security($_POST["phone"]);
	
	$memberQuery = $dbConnect->prepare("UPDATE users SET name = ?, phone = ? WHERE email = ?");
	$memberQuery->execute([$name, $phone, $_SESSION["useremail"]]);
	$memberNum = $memberQuery->rowCount();
	
	if ($memberNum > 0) {
		$_SESSION["updateinfook"] = "Bilgileriniz güncellendi.";
	} 

	header("Location: /account.php");
}

// END UPDATE ACCOUNT INFO //



// UPDATE PASSWORD //

if (array_key_exists('updatepassword', $_POST)) {

	$p1 = Security($_POST["password"]);
	$password = md5($p1);

	$p2 = Security($_POST["newpassword"]);
	$newpassword = md5($p2);

	$p3 = Security($_POST["repassword"]);
	$repassword = md5($p3);	
	
	if ($newpassword == $repassword) {
		$memberQuery = $dbConnect->prepare("UPDATE users SET password = ? WHERE email = ? and password = ?");
		$memberQuery->execute([$newpassword, $_SESSION["useremail"], $password]);	
		$memberNum = $memberQuery->rowCount();
		if ($memberNum > 0) {
			$_SESSION["updatepassok"] = "Şifreniz değiştirildi.";
			header("Location: /account.php" . $url);
		} else {
			$_SESSION["updatepasserror"] = "Şifrenizi hatalı girdiniz.";
			header("Location: /account.php" . $url);
		}
	} else {
		$_SESSION["updatepasserror"] = "Girdiğiniz şifreler uyuşmamaktadır.";
		header("Location: /account.php" . $url);
	}

}

// END UPDATE PASSWORD //



// RE PASSWORD //

if (array_key_exists('repassword', $_POST)) {

	$inputemail = Security($_POST["email"]);

	$memberQuery = $dbConnect->prepare("SELECT * FROM users WHERE email = ?");
	$memberQuery->execute([$inputemail]);
	$memberNum = $memberQuery->rowCount();
	$user = $memberQuery->fetch(PDO::FETCH_ASSOC);	

	if ($memberNum == 1) {
	header("Location: /mailler/repassmail.php?email=" . $inputemail);	
	} else {
			$_SESSION["error"] = "Girdiğiniz e-posta adresine kayıtlı üyelik bulunamadı.";
			header("Location: /");		
	}

}

// END RE PASSWORD //


// ADD BALANCE WITH CART //

if (array_key_exists('addbalancecart', $_POST)) {


	if (isset($_POST["inputBalance"])) {
		$inputBalance = Security($_POST["inputBalance"]);
	} else
	$inputBalance = "";	


	if (isset($_SESSION["useremail"])) {
		$memberQuery = $dbConnect->prepare("SELECT * FROM users WHERE email = ?");
		$memberQuery->execute([$_SESSION["useremail"]]);
		$memberNum = $memberQuery->rowCount();
		$user = $memberQuery->fetch(PDO::FETCH_ASSOC);
		$user_id = $user["id"];
	} else
	header("Location: /");


	$order_number = generateOrderId();

	$orderİnsertQuery = $dbConnect->prepare("INSERT INTO orders_balance (order_number, user_id, payment, price, statu, created_at) values (?,?,?,?,?,?)");
	$orderİnsertQuery->execute([$order_number, $user_id, null, $inputBalance, 0, $time]);
	$insertOrderControl = $orderİnsertQuery->rowCount();

	if ($insertOrderControl > 0) {
		header("Location:/payment.php?oidnmbr=$order_number");
		exit();
	} else {
		echo "error orderinsert HATA KODU: 546700283564";
	}	

}

// END BALANCE WITH CART //



// ADD BALANCE WITH HAVALE //

if (array_key_exists('addbalancehavale', $_POST)) {


	if (isset($_POST["inputBalance"])) {
		$inputBalance = Security($_POST["inputBalance"]);
	} else
	$inputBalance = "";	


	if (isset($_SESSION["useremail"])) {
		$memberQuery = $dbConnect->prepare("SELECT * FROM users WHERE email = ?");
		$memberQuery->execute([$_SESSION["useremail"]]);
		$memberNum = $memberQuery->rowCount();
		$user = $memberQuery->fetch(PDO::FETCH_ASSOC);
		$user_id = $user["id"];
	} else
	header("Location: /");


	$order_number = generateOrderId();

	$orderİnsertQuery = $dbConnect->prepare("INSERT INTO orders_chip (order_number, user_id, payment, price, statu, created_at) values (?,?,?,?,?,?)");
	$orderİnsertQuery->execute([$order_number, $user_id, 0, $inputBalance, 0, $time]);
	$insertOrderControl = $orderİnsertQuery->rowCount();

	if ($insertOrderControl > 0) {
		header("Location: /paymentnoti.php?balance=" . $inputBalance);
		exit();
	} else {
		echo "error orderinsert HATA KODU: 55492702163";
	}	

}

// END BALANCE WITH HAVALE //







// START INSERT ORDER // 

if (array_key_exists('makeorder', $_POST)) {

	if (isset($_POST["pid"])) {
		$pid = Security($_POST["pid"]);
		$productQuery = $dbConnect->prepare("SELECT * FROM product WHERE statu = 1 and id = ?");
		$productQuery->execute([$pid]);
		$productNum = $productQuery->rowCount();	
		$product = $productQuery->fetch(PDO::FETCH_ASSOC);
		$total = $product["price"];
	} else {
		header("Location: /");
		exit();
	} 	

	if (isset($_POST["num_product"])) {
		$num_product = Security($_POST["num_product"]);
		if ($num_product < 1 || $num_product > 999) {
			header('Location: ' . $backurl);
			exit();
		} else {
			$total = $total*$num_product;
		}
		
	} else {
		header("Location: /");
		exit();
	}

	if (isset($_POST["in_name"])) {
		$in_name = Security($_POST["in_name"]);
		$_SESSION["in_name"] = $in_name;
	} else
	$in_name = "";


	if (isset($_POST["in_facemail"])) {
		$in_facemail = Security($_POST["in_facemail"]);
	} else
	$in_facemail = "";


	if (isset($_POST["in_facepass"])) {
		$in_facepass = Security($_POST["in_facepass"]);
	} else
	$in_facepass = "";	


	if (isset($_POST["in_gameid"])) {
		$in_gameid = Security($_POST["in_gameid"]);
	} else
	$in_gameid = "";


	if (isset($_POST["in_phone"])) {
		$in_phone = Security($_POST["in_phone"]);
		$_SESSION["in_phone"] = $in_phone;
	} else
	$in_phone = "";


	if (isset($_POST["in_vip"])) {
		if ($_POST["in_vip"] == 0) { ?>
			$vip = 0;
			<?php	
		} else {
			$in_vip = Security($_POST["in_vip"]);
			$vipQuery = $dbConnect->prepare("SELECT * FROM zynga_vip WHERE id = ?");
			$vipQuery->execute([$in_vip]);
			$vipNum = $vipQuery->rowCount();
			$vip = $vipQuery->fetch(PDO::FETCH_ASSOC);

			if ($vipNum == 1) {
				$total = $total + $vip["price"];
			}
		}

	} else
	$in_vip = "";	


	if (isset($_SESSION["useremail"])) {
		$memberQuery = $dbConnect->prepare("SELECT * FROM users WHERE email = ?");
		$memberQuery->execute([$_SESSION["useremail"]]);
		$memberNum = $memberQuery->rowCount();
		$user = $memberQuery->fetch(PDO::FETCH_ASSOC);
		$user_id = $user["id"];
	} else {
		$user_id = 999;
		$_SESSION['is_visitor'] = "true";
	}
	


	$order_number = generateOrderId();


	$orderİnsertQuery = $dbConnect->prepare("INSERT INTO orders (order_number, user_id, in_name, in_facemail, in_facepass, in_phone, in_gameid, in_vip, payment, category, product, qty, price, statu, created_at) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$orderİnsertQuery->execute([$order_number, $user_id, $in_name, $in_facemail, $in_facepass, $in_phone, $in_gameid, $in_vip, null, $product["category_id"], $product["id"], $product["qty"]*$num_product, $total, 0, $time]);
	$insertOrderControl = $orderİnsertQuery->rowCount();

	if ($insertOrderControl > 0) {
		header("Location:/payment.php?oidnmbr=$order_number");
		exit();
	} else {
		echo "error orderinsert";
	}	


}

// END INSERT ORDER // 




// START INSERT ORDER WITH PACKET // 

if (array_key_exists('makeorderpacket', $_POST)) {

	if (isset($_POST["category"])) {
		$category = Security($_POST["category"]);

		$categoryQuery = $dbConnect->prepare("SELECT * FROM category WHERE statu = 1 and id = ?");
		$categoryQuery->execute([$category]);
		$categoryNum = $categoryQuery->rowCount();	
		$catg = $categoryQuery->fetch(PDO::FETCH_ASSOC);
	} else
	$category = "";

	if (isset($_POST["inputBalance"])) {
		$price = Security($_POST["inputBalance"]);
		$total = (float)$price;

		$qty = $total/$catg["price"];

	} else {
		header("Location: /" . $url);
		exit();
	}	

	if (isset($_POST["in_name"])) {
		$in_name = Security($_POST["in_name"]);
	} else
	$in_name = "";


	if (isset($_POST["in_facemail"])) {
		$in_facemail = Security($_POST["in_facemail"]);
	} else
	$in_facemail = "";


	if (isset($_POST["in_facepass"])) {
		$in_facepass = Security($_POST["in_facepass"]);
	} else
	$in_facepass = "";	


	if (isset($_POST["in_gameid"])) {
		$in_gameid = Security($_POST["in_gameid"]);
	} else
	$in_gameid = "";


	if (isset($_POST["in_phone"])) {
		$in_phone = Security($_POST["in_phone"]);
	} else
	$in_phone = "";


	if (isset($_POST["in_vip"])) {
		if ($_POST["in_vip"] == "0") { ?>
			$vip = 0;
			<?php	
		} else {
			$in_vip = Security($_POST["in_vip"]);
			$vipQuery = $dbConnect->prepare("SELECT * FROM zynga_vip WHERE id = ?");
			$vipQuery->execute([$in_vip]);
			$vipNum = $vipQuery->rowCount();
			$vip = $vipQuery->fetch(PDO::FETCH_ASSOC);

			if ($vipNum == 1) {
				$total = $total + $vip["price"];
			}
		}

	} else
	$in_vip = "";	


	if (isset($_SESSION["useremail"])) {
		$memberQuery = $dbConnect->prepare("SELECT * FROM users WHERE email = ?");
		$memberQuery->execute([$_SESSION["useremail"]]);
		$memberNum = $memberQuery->rowCount();
		$user = $memberQuery->fetch(PDO::FETCH_ASSOC);
		$user_id = $user["id"];
	} else
	$user_id = 999;


	$order_number = generateOrderId();



	$orderİnsertQuery = $dbConnect->prepare("INSERT INTO orders (order_number, user_id, in_name, in_facemail, in_facepass, in_phone, in_gameid, in_vip, payment, category, qty, price, statu, created_at) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$orderİnsertQuery->execute([$order_number, $user_id, $in_name, $in_facemail, $in_facepass, $in_phone, $in_gameid, $in_vip, 0, $category, $qty, $total, 0, $time]);
	$insertOrderControl = $orderİnsertQuery->rowCount();

	if ($insertOrderControl > 0) {
		header("Location:/payment.php?oidnmbr=$order_number");
		exit();
	} else {
		echo "error orderinsert";
	}	


}

// END INSERT ORDER WITH PACKET// 




// PAY WITH BALANCE //

if (array_key_exists('paywithbalance', $_POST)) {

	$memberQuery = $dbConnect->prepare("SELECT * FROM users WHERE email = ?");
	$memberQuery->execute([$_SESSION["useremail"]]);
	$memberNum = $memberQuery->rowCount();
	$user = $memberQuery->fetch(PDO::FETCH_ASSOC);	
	
	$orderQuery = $dbConnect->prepare("SELECT * FROM orders WHERE id = ?");
	$orderQuery->execute([$_POST["paywithbalance"]]);
	$orderNum = $orderQuery->rowCount();
	$order = $orderQuery->fetch(PDO::FETCH_ASSOC);

	$productQuery = $dbConnect->prepare("SELECT * FROM product WHERE id = ?");
	$productQuery->execute([$order["product"]]);
	$productNum = $productQuery->rowCount();
	$product = $productQuery->fetch(PDO::FETCH_ASSOC); 

	if ($productNum == 1) {
		$product_title = $product["title"];
	} else {
		$product_title = "Özel Paket";
	} 

	if ($orderNum == 0) {
		
		echo "error - code: 54831033546889";
		exit();
		session_destroy();
		header("Location: /");

	} else {

		if ($user["id"] == $order["user_id"] and $user["balance"] >= $order["price"]) {
			$memberQuery = $dbConnect->prepare("UPDATE users SET balance = balance - ? WHERE id = ?");
			$memberQuery->execute([$order["price"], $user["id"]]);	
			$memberNum = $memberQuery->rowCount();
			if ($memberNum == 1) {
				$orderStatuQuery = $dbConnect->prepare("UPDATE orders SET statu = 1, payment = 2 WHERE id = ?");
				$orderStatuQuery->execute([$order["id"]]);
				header("Location: /orders.php" . $url);
			} else {
				$_SESSION["payerror"] = "Ödeme alınamadı.";
				header("Location: /orders.php");
			}
		} else {
			session_destroy();
			header("Location: /");
		}
	}
}

// END PAY WITH BALANCE //






// USER LOGOUT START //

if (array_key_exists('logout', $_GET)) {
	session_destroy();
	header("Location: /");
}



function generateOrderId($length = 5) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

function generateRefCode($length = 15) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}


?>