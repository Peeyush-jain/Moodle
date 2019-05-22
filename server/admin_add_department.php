<?php


	// This is used to add a department

	session_start();

	// admin's id can be accessed using $user_id
	// $user_id = $_SESSION['user_id'];

	// First check if user with user id = $user_id is actually admin or not
	// If that user is not admin then err = "Error occured";

	// Assume admin's attribute like name, etc...
	// For example: $name = $_POST['name'];

	/*

		Write your code here;


	*/



	// IF succesfully added then $data->err = "OK";
	// ELSE if any error occur make $data->err = error message;

	
	$data = new stdClass();
	$data->err = "OK";
	
	echo json_encode($data);
?>