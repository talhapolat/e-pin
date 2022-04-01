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
	if (isset($_SESSION["useremail"])) {
		$email = $user["email"];
	} else {
		$email = "visitor@chipkolikgame.com";
	}
	
	#
	## Tahsil edilecek tutar.
	$payment_amount	= round($totalprice*(100 + $setting["commission_rate"])) ; //9.99 için 9.99 * 100 = 999 gönderilmelidir.
	#
	## Sipariş numarası: Her işlemde benzersiz olmalıdır!! Bu bilgi bildirim sayfanıza yapılacak bildirimde geri gönderilir.
	$merchant_oid = $ordernumb;
	#
	## Müşterinizin sitenizde kayıtlı veya form aracılığıyla aldığınız ad ve soyad bilgisi
	if (isset($_SESSION["useremail"])) {
		$user_name = $user["name"];
	} elseif (isset($_SESSION["in_name"])) {
		$user_name = $_SESSION["in_name"];
	} else {
		$user_name = "Visitor";
	}
	
	#
	## Müşterinizin sitenizde kayıtlı veya form aracılığıyla aldığınız adres bilgisi
	$user_address = "Turkiye";
	#
	## Müşterinizin sitenizde kayıtlı veya form aracılığıyla aldığınız telefon bilgisi
	if (isset($_SESSION["useremail"])) {
		$user_phone = $user["phone"];
	} elseif(isset($_SESSION["useremail"])) {
		$user_phone = $_SESSION["in_phone"];
	} else {
		$user_phone = "05300000000";
	}
	
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
	$user_basket = base64_encode(json_encode(array(
    array("URUN", $totalprice, 1),
    array("KMSYN", ($payment_amount/100)-$totalprice, 1)
	)));
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
	$debug_on = 0;

    ## Mağaza canlı modda iken test işlem yapmak için 1 olarak gönderilebilir.
	$test_mode = 0;

	$no_installment	= 0; // Taksit yapılmasını istemiyorsanız, sadece tek çekim sunacaksanız 1 yapın

	## Sayfada görüntülenecek taksit adedini sınırlamak istiyorsanız uygun şekilde değiştirin.
	## Sıfır (0) gönderilmesi durumunda yürürlükteki en fazla izin verilen taksit geçerli olur.
	$max_installment = 12;

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
	<script src="https://www.paytr.com/js/iframeResizer.min.js"></script>
	<!-- Ödeme formunun açılması için gereken HTML kodlar / Başlangıç -->
	<iframe src="https://www.paytr.com/odeme/guvenli/<?php echo $token;?>" id="paytriframe" frameborder="0" scrolling="no" style="width: 100%;"></iframe>
	<script>iFrameResize({},'#paytriframe');</script>
	<!-- Ödeme formunun açılması için gereken HTML kodlar / Bitiş -->
