<?php

$token = array('token' => 'Zsh0UXjDre');

$json_token = json_encode($token);

// get string

	function postData($url, $data) {
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);

	return $result;
}


$result = postData('http://challenge.code2040.org/api/getstring', $json_token);

if(!$result) {
	echo "There was a problem getting the string";
	exit();
}

// convert JSON object to string
$obj = json_decode($result);

foreach ($obj as $key => $val) {

		$string = $val;
	}


// reverse string
$reverse = strrev($string);


//set reversed string and token in array
$answer = array(
'token' => 'Zsh0UXjDre',
'string' => $reverse);

$json_answer = json_encode($answer);


//POST answer 
$result = postData('http://challenge.code2040.org/api/validatestring', $json_answer);


echo $result;

?> 
