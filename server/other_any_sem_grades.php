<?php


	// This is used to get any student's given semester's performance

	session_start();
	// student's email can be obtained from $_POST['email']
	// $email = $_POST['email'];

	// year number can be obtained from $_POST['year']
	// $year = $_POST['year'];

	// fall or spring number can be obtained from $_POST['fall']
	// $is_fall = $POST['fall'];
	// $_POST['fall'] = 1 or 0


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