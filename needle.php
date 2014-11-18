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

$result = postData('http://challenge.code2040.org/api/haystack', $json_token);


//transfer JSON object to array
$obj = json_decode($result, TRUE);

//pass needle and haystack to string and array variables
$array = array();
for($i=0;$i<count($obj['result']['haystack']); $i++) {
	
	$array[] = $obj['result']['haystack'][$i];
}
$string = $obj['result']['needle'];

// look for position of string in array
$position = array_search($string, $array);


//send error message if it's not found
if ($position === FALSE) {
	echo "Could not find the string in the array.";
	exit();
}


$info = array('token' => 'Zsh0UXjDre',
	'needle' => $position);


$json_info = json_encode($info);

//Send info
$answer = postData('http://challenge.code2040.org/api/validateneedle', $json_info);

echo $answer;

?>