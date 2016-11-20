<?php 

include_once(dirname(dirname(__FILE__)) . '/src/SandCage.php');

use SandCage\SandCage;

$sandcage = new SandCage;

$payload = array(
	'request_id' => '[request_id]'
);

$sandcage->call('getInfo', $payload);
$get_info_status = $sandcage->getHttpStatus();
$get_info_response = $sandcage->getResponse();

if ($get_info_status['http_code'] == 200) {
	echo $get_info_response;
} else {
	echo "An error occurred.";
}
