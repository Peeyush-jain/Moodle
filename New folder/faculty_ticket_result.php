<?php


	// This is used to get result ie.. accept or reject faculty's particular ticket

	session_start();
	// user_id can be accessed using $_SESSION['user_id'];
	// $user_id = $_SESSION['user_id'];

	// $ticket_id = $_POST['ticket_id'];
	// $accepted = $_POST['accepted']; // 0 or 1

	/*

		Write your code here;


	*/



	// IF succesfull then $data->err = "OK";
	// ELSE if any error occur make $data->err = error message;
	
	$data = new stdClass();
	$data->err = "OK";
	$data->course = array("Artificial Intelligence","Machine Learning");
	$data->content = array("Request accepted by CKN sir","Request rejected by Apurva sir");

	echo json_encode($data);
?>