<?php
if ( ! function_exists('sendMessage')) {
ini_set('MAX_EXECUTION_TIME', -1);
function sendMessage($data,$target){
//FCM api URL
$url = 'https://fcm.googleapis.com/fcm/send';
//api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
//$server_key = 'AIzaSyCWzHlWXb1Tui-KJpz0SK7lhjrDqIwgw-U';
$server_key = 'AAAAQMWmbCg:APA91bFrEBCI9aNmPUsLqsLEhbMu2fN9qL5s2DPzYWqjOCHA784xk5BhDIE4ivU038tGF619ukoYmOoF6u5NKLKITQy1vCn37Oc_G_aNl7AuLH1hJ6Fcek8UofCgTiWVVQne9VspJ_fW';
			
$fields = array();
$fields['data'] = $data;
if(is_array($target)){
	$fields['registration_ids'] = $target;
}else{
	$fields['to'] = $target;
}

//header with content_type api key
$headers = array(
	'Content-Type:application/json',
  'Authorization:key='.$server_key
);
			
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
$result = curl_exec($ch);
file_put_contents('28.txt', print_r($result,1).PHP_EOL, FILE_APPEND);
//file_put_contents('29.txt', print_r($target,1).PHP_EOL, FILE_APPEND);

if ($result === FALSE) {
	die('FCM Send Error: ' . curl_error($ch));
}
curl_close($ch);
return $result;
}
}