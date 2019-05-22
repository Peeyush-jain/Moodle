<?php


	// This is used to update a hod

	session_start();

	// admin's id can be accessed using $user_id
	// $user_id = $_SESSION['user_id'];

	// First check if user with user id = $user_id is actually admin or not
	// If that user is not admin then err = "Error occured";

	// department_id = $_POST['department']
	// new_hod_id = $_POST['hod_id'];

	/*

		Write your code here;


	*/



	// IF succesfully added then $data->err = "OK";
	// ELSE if any error occur make $data->err = error message;

	
	$data = new stdClass();
	$data->err = "OK";
	
	echo json_encode($data);
?>