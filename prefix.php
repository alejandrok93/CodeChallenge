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

//get info and transfer to array that I can work with
$result = postData('http://challenge.code2040.org/api/prefix', $json_token);
$prefix = json_decode($result, TRUE);
$string = $prefix['result']['prefix'];


$prefixarray = array();
	foreach ($prefix['result']['array'] as $key => $val){
	$prefixarray[] = $val;
}


$nonprefix = array();
$found = null;
for($i=0;$i<count($prefixarray);$i++) {

// check to see if it finds prefix string in array
$found = strpos($prefixarray[$i], $string);
	if ($found === FALSE){

		$nonprefix[] = $prefixarray[$i];

	}

}

//POST data
$info = array('token' => 'Zsh0UXjDre',
	'array' => $nonprefix);

$json_info = json_encode($info);

$ans = postData('http://challenge.code2040.org/api/validateprefix', $json_info);

echo $ans;



?>