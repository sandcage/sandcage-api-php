<?php 

include_once(dirname(dirname(__FILE__)) . '/src/SandCage.php');

$sandcage = new SandCage;

$payload = array(
	'files' => array(
		array('reference_id' => '[reference_id]'),
		array('file_token' => '[file_token]')
	)
);

$sandcage->destroyFiles($payload);
// $sandcage->destroyFiles($payload, 'http://www.example.com/callback_url'); // Same call with the optional callback endpoint set
$get_info_status = $sandcage->getHttpStatus();
$get_info_response = $sandcage->getResponse();

if ($get_info_status['http_code'] == 200) {
	echo $get_info_response;
} else {
	echo "An error occured.";
}
