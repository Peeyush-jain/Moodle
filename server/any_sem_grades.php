<?php


	// This is used to get student's given semester's performance

	// year number can be obtained from $_POST['year']
	// fall or spring number can be obtained from $_POST['fall']
	// $_POST['fall'] = 1 or 0

	session_start();
	
	// user_id can be accessed using $_SESSION['user_id'];
	// $user_id = $_SESSION['user_id'];

	// year can be accessed
	// $year = $_POST['year'];

	// fall can be accessed
	// $fall = $_POST['fall'];

	/*

		Write your code here;


	*/



	// IF succesfull then $data->err = "OK";
	// ELSE if any error occur make $data->err = error message;
	
	$data = new stdClass();
	$data->err = "OK";
	$data->name = "Pratik Chhajer";
	$data->entry = "2015CSB1025";
	$data->course_id = array(1071,2521);
	$data->course_name = array("Artificial Intelligence","Machine Learning");
	$data->credit = array(4,3);
	$data->grade = array("A","B-");
	$data->sgpa = 8.84;
	$data->cgpa = 9.86;

	echo json_encode($data);
?>