<?php


	// This is used to get any student's all semester performance

	session_start();

	// student's email can be obtained from $_POST['email']
	// $email = $_POST['email'];

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
	$data->sgpa = 8.2;
	$data->cgpa = 9.8;

	echo json_encode($data);
?>