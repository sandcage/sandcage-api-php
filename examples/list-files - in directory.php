<?php 

include_once(dirname(dirname(__FILE__)) . '/src/SandCage.php');

$sandcage = new SandCage;

$payload = array(
	'directory' => '[relative directory]'
);

$sandcage->listFiles($payload);
$list_files_status = $sandcage->getHttpStatus();
$list_files_response = $sandcage->getResponse();

if ($list_files_status['http_code'] == 200) {
	echo $list_files_response;
} else {
	echo "An error occurred.";
}
