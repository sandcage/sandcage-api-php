<?php 

include_once(dirname(dirname(__FILE__)) . '/src/SandCage.php');

$sandcage = new SandCage;

$payload = array(
	'files' => array(
		array('file_token' => '[file_token 1]'),
		array('file_token' => '[file_token 2]'),
		array('file_token' => '[file_token 3]')
	)
);

$sandcage->getInfo($payload);
$get_info_status = $sandcage->getHttpStatus();
$get_info_response = $sandcage->getResponse();

if ($get_info_status['http_code'] == 200) {
	echo $get_info_response;
} else {
	echo "An error occured.";
}
