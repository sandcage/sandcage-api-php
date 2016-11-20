<?php 

include_once(dirname(dirname(__FILE__)) . '/src/SandCage.php');

use SandCage\SandCage;

$sandcage = new SandCage;

$payload = array(
	'page' => 1,
	'results_per_page' => 10
);

$sandcage->call('list-files', $payload);

if ($sandcage->status['http_code'] == 200) {
	echo $sandcage->response;
} else {
	echo "An error occurred.";
}
