<?php 

include_once(dirname(dirname(__FILE__)) . '/src/SandCage.php');

use SandCage\SandCage;

$sandcage = new SandCage;

$payload = array(
	'files' => array(
		array('file_token' => '[file_token 1]'),
		array('file_token' => '[file_token 2]'),
		array('file_token' => '[file_token 3]')
	)
);

$sandcage->call('get-info', $payload);

if ($sandcage->status['http_code'] == 200) {
	echo $sandcage->response;
} else {
	echo "An error occurred.";
}
