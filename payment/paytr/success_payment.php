<?php
require_once("../../app/connect.php");

	## 2. ADIM için örnek kodlar ##
	## ÖNEMLİ UYARILAR ##
	## 1) Bu sayfaya oturum (SESSION) ile veri taşıyamazsınız. Çünkü bu sayfa müşterilerin yönlendirildiği bir sayfa değildir.
	## 2) Entegrasyonun 1. ADIM'ında gönderdiğniz merchant_oid değeri bu sayfaya POST ile gelir. Bu değeri kullanarak
	## veri tabanınızdan ilgili siparişi tespit edip onaylamalı veya iptal etmelisiniz.
	## 3) Aynı sipariş için birden fazla bildirim ulaşabilir (Ağ bağlantı sorunları vb. nedeniyle). Bu nedenle öncelikle
	## siparişin durumunu veri tabanınızdan kontrol edin, eğer onaylandıysa tekrar işlem yapmayın. Örneği aşağıda bulunmaktadır.

$post = $_POST;

	####################### DÜZENLEMESİ ZORUNLU ALANLAR #######################
	#
	## API Entegrasyon Bilgileri - Mağaza paneline giriş yaparak BİLGİ sayfasından alabilirsiniz.
$merchant_key 	= $setting["merchant_key"];
$merchant_salt	= $setting["merchant_salt"];
if ($post['payment_type'] == 'card') {
	$payment_type = 1;
} else {
	$payment_type = 0;
}
	###########################################################################

	####### Bu kısımda herhangi bir değişiklik yapmanıza gerek yoktur. #######
	#
	## POST değerleri ile hash oluştur.
$hash = base64_encode( hash_hmac('sha256', $post['merchant_oid'].$merchant_salt.$post['status'].$post['total_amount'], $merchant_key, true) );
	#
	## Oluşturulan hash'i, paytr'dan gelen post içindeki hash ile karşılaştır (isteğin paytr'dan geldiğine ve değişmediğine emin olmak için)
	## Bu işlemi yapmazsanız maddi zarara uğramanız olasıdır.
if( $hash != $post['hash'] )
	die('PAYTR notification failed: bad hash');
	###########################################################################

	## BURADA YAPILMASI GEREKENLER
	## 1) Siparişin durumunu $post['merchant_oid'] değerini kullanarak veri tabanınızdan sorgulayın.
	## 2) Eğer sipariş zaten daha önceden onaylandıysa veya iptal edildiyse  echo "OK"; exit; yaparak sonlandırın.

	/* Sipariş durum sorgulama örnek
 	   $durum = SQL
	   if($durum == "onay" || $durum == "iptal"){
			echo "OK";
			exit;
		}
	 */

		$orderQuery = $dbConnect->prepare("SELECT * FROM orders WHERE order_number = ?");
		$orderQuery->execute([$post['merchant_oid']]);
		$orderNum = $orderQuery->rowCount();
		$order = $orderQuery->fetch(PDO::FETCH_ASSOC);	

		if ($orderNum == 1) {

			$productQuery = $dbConnect->prepare("SELECT * FROM product WHERE id = ?");
			$productQuery->execute([$order["product"]]);
			$productNum = $productQuery->rowCount();
			$product = $productQuery->fetch(PDO::FETCH_ASSOC); 

			if ($productNum == 1) {
				$product_title = $product["title"];
			} else {
				$product_title = "Özel Paket";
			} 


			if ($order["statu"] != 0 ) {
				echo "OK";
				exit();
			} else {
				if ($post['status'] == 'success') {
					$orderSQuery = $dbConnect->prepare("UPDATE orders SET statu = 1, payment = ? WHERE order_number = ?");
					$orderSQuery->execute([$payment_type, $post['merchant_oid']]);
					$insertControl = $orderSQuery->rowCount();
					if ($insertControl != 1) {
						echo "Sipariş statu güncellenmedi (statu=1)";
						exit();
					}
					echo "OK";
					exit();
				} else {
					$orderSQuery = $dbConnect->prepare("UPDATE orders SET statu = 2, payment = ? WHERE order_number = ?");
					$orderSQuery->execute([$payment_type, $post['merchant_oid']]);
					$insertControl = $orderSQuery->rowCount();
					if ($insertControl != 1) {
						echo "Sipariş statu güncellenmedi (statu=2)";
						exit();
					}
					echo "OK";
					exit();
				}
			}
		} else {
			$orderBQuery = $dbConnect->prepare("SELECT * FROM orders_balance WHERE order_number = ?");
			$orderBQuery->execute([$post['merchant_oid']]);
			$orderBNum = $orderBQuery->rowCount();
			$orderB = $orderBQuery->fetch(PDO::FETCH_ASSOC);	

			if ($orderBNum == 1) {
				if ($orderB["statu"] != 0 ) {
					echo "OK";
					exit();
				} else {
					if ($post['status'] == 'success') {
						$orderBSuccessQuery = $dbConnect->prepare("UPDATE orders_balance SET statu = 1, payment = ? WHERE order_number = ?");
						$orderBSuccessQuery->execute([$payment_type, $post['merchant_oid']]);
						$insertControl = $orderBSuccessQuery->rowCount();
						if ($insertControl != 1) {
							echo "Bakiye sipariş statu güncellenmedi (statu=1)";
							exit();
						} else {
							$userChangeBalance = $dbConnect->prepare("UPDATE users SET balance = balance + ? WHERE id = ?");
							$userChangeBalance->execute([$orderB["price"], $orderB["user_id"]]); 
							$insertControl = $userChangeBalance->rowCount();
							echo "OK";
							exit();
						}

					} else {
						$orderBSuccessQuery = $dbConnect->prepare("UPDATE orders_balance SET statu = 2, payment = ? WHERE order_number = ?");
						$orderBSuccessQuery->execute([$payment_type, $post['merchant_oid']]);
						echo "OK";
						exit();	
					}
				}
			} else {
				echo "Siparis Kaydi Bulunamadi";
				exit();
			}		
		}

		?>