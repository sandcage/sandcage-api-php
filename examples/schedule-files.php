<?php 

include_once(dirname(dirname(__FILE__)) . '/src/SandCage.php');

use SandCage\SandCage;

$sandcage = new SandCage;

$payload = array(
	'jobs'=>array(
		array(
			'url'=>'http://cdn.sandcage.com/p/a/img/logo.jpg',
			'tasks'=>array(
				array(
					'actions'=>'save'
				),
				array(
					'actions'=>'resize',
					'filename'=>'hello_world.jpg',
					'width'=>200
				),
				array(
					'actions'=>'crop',
					'coords'=>'10,10,50,50'
				),
				array(
					'reference_id'=>'1234567890',
					'actions'=>'rotate',
					'degrees'=>90
				),
				array(
					'actions'=>'cover',
					'width'=>60,
					'height'=>60,
					'cover'=>'middle,center'

				)
			)
		),
		array(
			'url'=>'http://cdn.sandcage.com/p/a/img/header_404.png',
			'tasks'=>array(
				array(
					'actions'=>'resize',
					'height'=>30
				)
			)
		)
	)
);

$sandcage->scheduleFiles($payload);
// $sandcage->scheduleFiles($payload, 'http://www.example.com/callback_url'); // Same call with the optional callback endpoint set
$get_info_status = $sandcage->getHttpStatus();
$get_info_response = $sandcage->getResponse();

if ($get_info_status['http_code'] == 200) {
	echo $get_info_response;
} else {
	echo "An error occurred.";
}
