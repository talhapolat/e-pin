<?php  
session_start();
ob_start();
require_once("app/connect.php");

if (!isset($_SESSION["useremail"])) {
  header("Location: /app/func.php?logout=ok");
} else {
  $userQuery   = $dbConnect->prepare("SELECT * FROM users WHERE email = ? and statu = 1");
  $userQuery->execute([$_SESSION["useremail"]]);
  $userNum     = $userQuery->rowCount();
  $user        = $userQuery->fetch(PDO::FETCH_ASSOC);

  if ($userNum != 1) {
    header("Location: /app/func.php?logout=ok");
  }
}



if (!isset($_GET["oidnmbr"])) {
  header("Location: /app/func.php?logout=ok");
} else {
  $orderQuery   = $dbConnect->prepare("SELECT * FROM orders WHERE order_number = ? and statu = 0 and deleted = 0");
  $orderQuery->execute([$_GET["oidnmbr"]]);
  $orderNum     = $orderQuery->rowCount();
  $order        = $orderQuery->fetch(PDO::FETCH_ASSOC);

  if ($orderNum == 0) {

  	$orderBQuery   = $dbConnect->prepare("SELECT * FROM orders_balance WHERE order_number = ? and statu = 0 and deleted = 0");
  	$orderBQuery->execute([$_GET["oidnmbr"]]);
  	$orderBNum     = $orderBQuery->rowCount();
  	$order        = $orderBQuery->fetch(PDO::FETCH_ASSOC);

  	if ($orderBNum == 0) {
  		header("Location: /app/func.php?logout=ok");
  	} else {
  		$ordernumb = $_GET["oidnmbr"];
  	}

  } else {
  	$ordernumb = $order["order_number"];
  }



}



?>

<!DOCTYPE html>
<html lang="en">

<?php include("sections/head.php") ?> 

<body class="animsition">
	
<?php include("sections/header.php") ?> 

	
<?php include("sections/duyuru.php") ?> 

  <!-- breadcrumb -->
  <div class="container">
    <div class="bread-crumb flex-w p-r-15 p-t-30 p-lr-0-lg">
      <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
        Anasayfa
        <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
      </a>

      <span class="stext-109 cl4">
        Ödeme Bilgileri
      </span>
    </div>
  </div>


<div class="container mt-5">	
<div class="row">

	<div class="col-md-9 col-12">

  
	<?php

	## 1. ADIM için örnek kodlar ##

	####################### DÜZENLEMESİ ZORUNLU ALANLAR #######################
	#
	## API Entegrasyon Bilgileri - Mağaza paneline giriş yaparak BİLGİ sayfasından alabilirsiniz.
	$merchant_id 	= $setting["merchant_id"];
	$merchant_key 	= $setting["merchant_key"];
	$merchant_salt	= $setting["merchant_salt"];
	#
	## Müşterinizin sitenizde kayıtlı veya form vasıtasıyla aldığınız eposta adresi
	$email = $user["email"];
	#
	## Tahsil edilecek tutar.
	$payment_amount	= ($order["price"] + $order["price"]*$setting["commission_rate"]/100)*100 ; //9.99 için 9.99 * 100 = 999 gönderilmelidir.
	#
	## Sipariş numarası: Her işlemde benzersiz olmalıdır!! Bu bilgi bildirim sayfanıza yapılacak bildirimde geri gönderilir.
	$merchant_oid = $ordernumb;
	#
	## Müşterinizin sitenizde kayıtlı veya form aracılığıyla aldığınız ad ve soyad bilgisi
	$user_name = $user["name"];
	#
	## Müşterinizin sitenizde kayıtlı veya form aracılığıyla aldığınız adres bilgisi
	$user_address = "Turkiye";
	#
	## Müşterinizin sitenizde kayıtlı veya form aracılığıyla aldığınız telefon bilgisi
	$user_phone = $user["phone"];
	#
	## Başarılı ödeme sonrası müşterinizin yönlendirileceği sayfa
	## !!! Bu sayfa siparişi onaylayacağınız sayfa değildir! Yalnızca müşterinizi bilgilendireceğiniz sayfadır!
	## !!! Siparişi onaylayacağız sayfa "Bildirim URL" sayfasıdır (Bakınız: 2.ADIM Klasörü).
	$merchant_ok_url = $setting["merchant_ok_url"];
	#
	## Ödeme sürecinde beklenmedik bir hata oluşması durumunda müşterinizin yönlendirileceği sayfa
	## !!! Bu sayfa siparişi iptal edeceğiniz sayfa değildir! Yalnızca müşterinizi bilgilendireceğiniz sayfadır!
	## !!! Siparişi iptal edeceğiniz sayfa "Bildirim URL" sayfasıdır (Bakınız: 2.ADIM Klasörü).
	$merchant_fail_url = $setting["merchant_fail_url"];
	#
	## Müşterinin sepet/sipariş içeriği
	$user_basket = "CHIP";
	#
	/* ÖRNEK $user_basket oluşturma - Ürün adedine göre array'leri çoğaltabilirsiniz
	$user_basket = base64_encode(json_encode(array(
		array("Örnek ürün 1", "18.00", 1), // 1. ürün (Ürün Ad - Birim Fiyat - Adet )
		array("Örnek ürün 2", "33.25", 2), // 2. ürün (Ürün Ad - Birim Fiyat - Adet )
		array("Örnek ürün 3", "45.42", 1)  // 3. ürün (Ürün Ad - Birim Fiyat - Adet )
	)));
	*/
	############################################################################################

	## Kullanıcının IP adresi
	if( isset( $_SERVER["HTTP_CLIENT_IP"] ) ) {
		$ip = $_SERVER["HTTP_CLIENT_IP"];
	} elseif( isset( $_SERVER["HTTP_X_FORWARDED_FOR"] ) ) {
		$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	} else {
		$ip = $_SERVER["REMOTE_ADDR"];
	}

	## !!! Eğer bu örnek kodu sunucuda değil local makinanızda çalıştırıyorsanız
	## buraya dış ip adresinizi (https://www.whatismyip.com/) yazmalısınız. Aksi halde geçersiz paytr_token hatası alırsınız.
	$user_ip = $ip;
	##

	## İşlem zaman aşımı süresi - dakika cinsinden
	$timeout_limit = "30";

	## Hata mesajlarının ekrana basılması için entegrasyon ve test sürecinde 1 olarak bırakın. Daha sonra 0 yapabilirsiniz.
	$debug_on = 1;

    ## Mağaza canlı modda iken test işlem yapmak için 1 olarak gönderilebilir.
    $test_mode = 0;

	$no_installment	= 1; // Taksit yapılmasını istemiyorsanız, sadece tek çekim sunacaksanız 1 yapın

	## Sayfada görüntülenecek taksit adedini sınırlamak istiyorsanız uygun şekilde değiştirin.
	## Sıfır (0) gönderilmesi durumunda yürürlükteki en fazla izin verilen taksit geçerli olur.
	$max_installment = 0;

	$currency = "TL";
	
	####### Bu kısımda herhangi bir değişiklik yapmanıza gerek yoktur. #######
	$hash_str = $merchant_id .$user_ip .$merchant_oid .$email .$payment_amount .$user_basket.$no_installment.$max_installment.$currency.$test_mode;
	$paytr_token=base64_encode(hash_hmac('sha256',$hash_str.$merchant_salt,$merchant_key,true));
	$post_vals=array(
			'merchant_id'=>$merchant_id,
			'user_ip'=>$user_ip,
			'merchant_oid'=>$merchant_oid,
			'email'=>$email,
			'payment_amount'=>$payment_amount,
			'paytr_token'=>$paytr_token,
			'user_basket'=>$user_basket,
			'debug_on'=>$debug_on,
			'no_installment'=>$no_installment,
			'max_installment'=>$max_installment,
			'user_name'=>$user_name,
			'user_address'=>$user_address,
			'user_phone'=>$user_phone,
			'merchant_ok_url'=>$merchant_ok_url,
			'merchant_fail_url'=>$merchant_fail_url,
			'timeout_limit'=>$timeout_limit,
			'currency'=>$currency,
            'test_mode'=>$test_mode
		);
	
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://www.paytr.com/odeme/api/get-token");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1) ;
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_vals);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 20);
	$result = @curl_exec($ch);

	if(curl_errno($ch))
		die("PAYTR IFRAME connection error. err:".curl_error($ch));

	curl_close($ch);
	
	$result=json_decode($result,1);
		
	if($result['status']=='success')
		$token=$result['token'];
	else
		die("PAYTR IFRAME failed. reason:".$result['reason']);
	#########################################################################

	?>

	<!-- Ödeme formunun açılması için gereken HTML kodlar / Başlangıç -->
    <script src="https://www.paytr.com/js/iframeResizer.min.js"></script>
    <iframe src="https://www.paytr.com/odeme/guvenli/<?php echo $token;?>" id="paytriframe" frameborder="0" scrolling="no" style="width: 100%;"></iframe>
	<script>iFrameResize({},'#paytriframe');</script>
	<!-- Ödeme formunun açılması için gereken HTML kodlar / Bitiş -->



	</div>

	<div class="col-md-3 justify-content-center desktopslider" style="background-color: ; border: 2px solid #f1f1f1;padding-top: 20px">

<?php include("sections/widgetlogin.php") ?>

	</div>

</div>


</div>




<!-- OYUNLAR -->
	<div class="sec-banner bg0 p-t-40 p-b-50">
		<div class="container">
			<div class="row">

				<div class="col-xl-9">



				</div>




				<div class="col-xl-3 ">


				</div>

				<div class="col-xl-3">
					
				</div>


			</div>


			
		</div>
	</div> 



	
<div class="text-center p-t-95" style="text-indent: center" >
<img src="images/sitealt_ftr.png" class="img-fluid">
</div>


<?php include("sections/footer.php") ?>


	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>


	<div id="fb-root"></div>



<?php include("sections/jsasset.php") ?>


</body>
</html>

<?php
$dbConnect = null;
$_SESSION["updatepassok"] = null;
$_SESSION["updatepasserror"] = null;
$_SESSION["updateinfook"] = null;
?>