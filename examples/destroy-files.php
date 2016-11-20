<?php 

include_once(dirname(dirname(__FILE__)) . '/src/SandCage.php');

use SandCage\SandCage;

$sandcage = new SandCage;

$payload = array(
	'files' => array(
		array('reference_id' => '[reference_id]'),
		array('file_token' => '[file_token]')
	)
);

$sandcage->call('destroy-files', $payload);
// $sandcage->call('destroy-files', $payload, 'http://www.example.com/callback_url'); // Same call with the optional callback endpoint set

if ($sandcage->status['http_code'] == 200) {
	echo $sandcage->response;
} else {
	echo "An error occurred.";
}
