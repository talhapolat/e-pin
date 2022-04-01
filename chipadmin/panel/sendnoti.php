<?PHP
function sendMessage() {
	$heading      = array(
        "en" => 'Yeni Sipariş!'
    );
    $content      = array(
        "en" => 'Zynga Chip siparişi geldi. Ödemesi alındı. Teslimat beklemektedir.'
    );
    $hashes_array = array();
    array_push($hashes_array, array(
        "id" => "like-button",
        "text" => "Sipariş Bilgileri",
        "url" => "https://chipkolikgame.com/chipadmin/panel/orders"
    ));
    $fields = array(
        'app_id' => "98c3a3e5-f9cc-413f-893f-cc290b542dbf",
        'included_segments' => array(
            'Subscribed Users'
        ),
        'data' => array(
            "foo" => "bar"
        ),
        'contents' => $content,
        'headings' => $heading,
        'web_buttons' => $hashes_array
    );
    
    $fields = json_encode($fields);
   
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic MzgwZDJjZWUtOWE4OS00NTcwLWI2MjUtNGFiMmM2MjkxNmY5'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}

$response = sendMessage();
$return["allresponses"] = $response;
$return = json_encode($return);

?>