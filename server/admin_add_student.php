<?php


	// This is used to resiter students 

	session_start();

	// admin's id can be accessed using $user_id
	// $user_id = $_SESSION['user_id'];

	// First check if user with user id = $user_id is actually admin or not
	// If that user is not admin then err = "Error occured";

	// Read .csv file line by line and add each student
	// Basically each row represents a student to be added to database
	// $file_to_red = $_POST['file_name'];

	/*

		Write your code here;


	*/



	// IF succesfully added then $data->err = "OK";
	// ELSE if any error occur make $data->err = error message;

	
	$data = new stdClass();
	$data->err = "OK";
	
	echo json_encode($data);
?>