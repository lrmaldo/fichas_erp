<?php

function sendMessage(){
		$content = array(
			"en" => 'Hola Sattlink 22May2019 6Msg'
		);
		
		$fields = array(
			'app_id' => "7a2562ec-f88e-4e10-be6a-4b115b40b25d",
			'filters' => array(array("field" => "tag", "key" => "", "relation" => "=", "value" => "10"),array("operator" => "OR"),array("field" => "amount_spent", "relation" => "=", "value" => "0")),
			'data' => array("foo" => "bar"),
			'contents' => $content
		);
		
		//'include_player_ids' => ["f2815f9b-e340-4bbe-813e-c80316079168"], //Api 27
		//'include_player_ids' => ["d79e80f6-04a8-4d55-beeb-cf75c436ead3"], //Api 27
		/*
		$fields = array(
			'app_id' => "7a2562ec-f88e-4e10-be6a-4b115b40b25d",
			'include_player_ids' => ["a3af0e92-11e2-4c8e-9118-48d6ef5b25fb"],
			'data' => array("foo" => "bar"),
			'contents' => $content
		);
		*/
		
		$fields = json_encode($fields);
    	//print("\nJSON sent:\n");
    	//print($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic NmUxYzE1NWQtY2ZhYi00MmNhLWJmZTctNGU1YTczMjA4Mzg3'));
		
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;
	}
	
	$response = sendMessage();
	//$return["allresponses"] = $response;
	//$return = json_encode( $return);
	echo json_encode( $response );

?>

