<?php 

include_once(dirname(dirname(__FILE__)) . '/SandCage.php');

$sandcage = new SandCage;

$payload = array(
	'files' => array(
		array('reference_id' => '[reference_id]')
	)
);

// NOTE | Add the callback to the example

$sandcage->destroyFiles($payload);
$get_info_status = $sandcage->getHttpStatus();
$get_info_response = $sandcage->getResponse();

if ( $get_info_status['http_code'] == 200 ) {
	echo $get_info_response;
} else {
	echo "An error occured.";
}

?>