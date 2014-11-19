<?php

$token = array('token' => 'Zsh0UXjDre');
$json_token = json_encode($token);

function postData($url, $data) {
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);

	return $result;
}

//Get date and seconds
$result = postData('http://challenge.code2040.org/api/time', $json_token);

$array = json_decode($result,TRUE);

$date = $array['result']['datestamp'];
$seconds = $array['result']['interval'];

//Convert to unix time
date_default_timezone_set('America/Los_Angeles');
$unixtime = strtotime($date);

//Add interval of seconds
$newdate = $unixtime + $seconds;


$data = date('c', $newdate);

$isodate = array('token' => 'Zsh0UXjDre' ,'datestamp' => $data);
$json_date = json_encode($isodate);


//POST data
$ans = postData('http://challenge.code2040.org/api/validatetime', $json_date);

echo $ans;

?>