<?php 

include_once(dirname(dirname(__FILE__)) . '/src/SandCage.php');

use SandCage\SandCage;

$sandcage = new SandCage;

$payload = array(
	'directory' => '[relative directory]'
);

$sandcage->call('list-files', $payload);

if ($sandcage->status['http_code'] == 200) {
	echo $sandcage->response;
} else {
	echo "An error occurred.";
}
