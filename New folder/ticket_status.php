<?php


	// This is used to get a student's all the tickets status

	session_start();
	// user_id can be accessed using $_SESSION['user_id'];
	// $user_id = $_SESSION['user_id'];

	/*

		Write your code here;


	*/



	// IF succesfully added then $data->err = "OK";
	// ELSE if any error occur make $data->err = error message;
	
	$data = new stdClass();
	$data->err = "OK";
	$data->course = array("Artificial Intelligence","Machine Learning");
	$data->content = array("Request accepted by CKN sir","Request rejected by Apurva sir");

	echo json_encode($data);
?>