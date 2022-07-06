<?php
    //====================================
    // Real-time Shipment Tracking php example
    // You can find the API-Key and Secret from--https://app.kd100.com/api-management
    //====================================

    // Parameters setting
    $key = '';                                // Your account API-Key
    $secret = '';                             // Your account Secret
    $param = array (
        'tracking_number' => '9926933413'     // The tracking number you want to query
    );
    
    // Request Json
    $json = json_encode($param, JSON_UNESCAPED_UNICODE);
    $signature = strtoupper(md5($json.$key.$secret));
    
    $url = 'https://www.kd100.com/api/v1/carriers/detect';    // Carrier-auto-detection request address
    
echo 'request headers key: '.$key;
echo '<br/>request headers signature: '.$signature;
echo '<br/>request json: '.$json;
    
    $headers = array (
        'Content-Type:application/json',
        'API-Key:'.$key,
        'signature:'.$signature,
		'Content-Length:'.strlen($json)
    );

    // Send post request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    $data = json_decode($result, true);

echo '<br/><br/>Return data:<br/><pre>';
echo print_r($data);
//echo var_dump($data);
echo '</pre>';
?>
