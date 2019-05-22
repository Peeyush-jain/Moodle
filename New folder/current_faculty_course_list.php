<?php

	// This is used to get list of all the courses floated by a particular faculty in currrent semester


	session_start();
	// user_id can be accessed using $_SESSION['user_id'];

	$course_id = array(1001, 1025);
	$course_name = array("Artificail Intelligence","Machine Learning");
	
	/*

		Write your code here;


	*/



	// IF succesfully then $data->err = "OK";
	// ELSE if any error occur make $data->err = error message;

	$data = new stdClass();
	$data->err = "OK";
	$data->course_id = $course_id;
	$data->course_name = $course_name;

	echo json_encode($data);
?>