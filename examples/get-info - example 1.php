<?php 

include_once(dirname(dirname(__FILE__)) . '/src/SandCage.php');

use SandCage\SandCage;

$sandcage = new SandCage;

$payload = array(
	'request_id' => '[request_id]'
);

$sandcage->call('get-info', $payload);

if ($sandcage->status['http_code'] == 200) {
	echo $sandcage->response;
} else {
	echo "An error occurred.";
}
