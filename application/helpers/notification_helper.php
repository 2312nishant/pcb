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
//file_put_contents('28.txt', print_r($result,1).PHP_EOL, FILE_APPEND);
//file_put_contents('29.txt', print_r($target,1).PHP_EOL, FILE_APPEND);

if ($result === FALSE) {
	die('FCM Send Error: ' . curl_error($ch));
}
curl_close($ch);
return $result;
}


//iOS Notification

function sendMessageiOS($data,$target){
//FCM api URL 
$passphrase = 'pcbnewsprod'; //pcb123

//$passphrase = 'pcbnewsdev'; //pcb123  dev

$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', 'PCBNEWS_PUSH_PROD.pem');
//stream_context_set_option($ctx, 'ssl', 'local_cert', 'PCBNEWS_PUSH_DEV.pem');
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

$body['aps'] = array(
	'alert' => $data['post_title'],
    'id'=> $data['post_id'],
	'sound' => 'default'
	);
// Open a connection to the APNS server
$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
//$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
file_put_contents('fp.txt', print_r($fp,1).PHP_EOL, FILE_APPEND);
if (!$fp)
	exit("Failed to connect: $err $errstr" . PHP_EOL);

echo 'Connected to APNS' . PHP_EOL;


// Encode the payload as JSON
$payload = json_encode($body);


// Build the binary notification
for($i=0; $i<count($target); $i++)
{
//$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
$msg = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $target[$i])) . chr(0) . chr(strlen($payload)) . $payload;
}

// Send it to the server
$result = fwrite($fp, $msg, strlen($msg));
file_put_contents('notification.txt', print_r($result,1).PHP_EOL, FILE_APPEND);
if (!$result)
	echo 'Message not delivered' . PHP_EOL;
else
	echo 'Message successfully delivered' . PHP_EOL;

// Close the connection to the server
fclose($fp);
}
}