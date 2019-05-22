<?php


	// This is used to register a new course by student.


	session_start();
	// user_id can be accessed using $_SESSION['user_id'];
	// $user_id = $_SESSION['user_id'];

	// Course's id can be accessed using
	// $course_id = $_POST['course_id'];


	/*

		Write your code here;


	*/



	// IF course is succesfully added then $data->err = "OK";
	// ELSE if any error occur make $data->err = error message;
	
	$data = new stdClass();
	$data->err = "OK";

	echo json_encode($data);
?>