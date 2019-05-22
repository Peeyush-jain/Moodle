<?php


	// This is used to add a new course by faculty into course catalogue.


	session_start();
	// user_id can be accessed using $_SESSION['user_id'];
	// $user_id = $_SESSION['user_id']

	// First check given user_id is a faculty or not
	

	/*

		Write your code here;


	*/



	// IF succesfull then $data->err = "OK";
	// ELSE if any error occur make $data->err = error message;
	$data = new stdClass();
	$data->err = "OK";

	echo json_encode($data);
?>