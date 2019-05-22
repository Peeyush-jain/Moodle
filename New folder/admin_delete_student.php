<?php


	// This is used to update a dean academics

	session_start();

	// admin's id can be accessed using $user_id
	// $user_id = $_SESSION['user_id'];

	// First check if user with user id = $user_id is actually admin or not
	// If that user is not admin then err = "Error occured";

	// new_dean_id = $_POST['dean_user_id'];

	/*

		Write your code here;


	*/



	// IF succesfully added then $data->err = "OK";
	// ELSE if any error occur make $data->err = error message;

	
	$data = new stdClass();
	$data->err = "OK";
	
	echo json_encode($data);
?>