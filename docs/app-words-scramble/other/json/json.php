<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

function runFunc() {
	if(!empty($_GET['key'])) {
		$maincateg = '';
		if(!empty($_GET['maincateg'])) {
			$maincateg = (string) $_GET['maincateg'];			
		}

		$key = (string) $_GET['key'];
		$json_file_name = '';
		$new_key = str_replace([' ', '__'], '_', strtolower($key));

		switch($new_key) {
			// case 'App Store Optimization':
			// 	$json_file_name = 'ai_writer_assistant.json';
			// 	break;
			case 'home':
				$json_file_name = 'home.json';
				break;

			default:
				$json_file_name = $new_key . '.json';
		}

		if($maincateg) {
			$maincateg = str_replace([' ', '__'], '_', strtolower($maincateg));
			$json_file_name = $maincateg . '/' . $json_file_name;
		}		

		if(!empty($json_file_name) && is_file($json_file_name)) {
			return [
				'success' => 1,
				'data' => @file_get_contents($json_file_name),
			];
		}
		return [
			'success' => 0,
			'new_key' => $new_key,
		];

	}
	
	return [
		'success' => 0,
		'data' => '[]',
	];
}

echo json_encode(runFunc());
exit(0);