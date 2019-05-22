<?php

	// This is used to get list of all the courses taken by a particular student in currrent semester

	session_start();
	// $user_id = $_SESSION['user_id'];
	// user_id can be accessed using $_SESSION['user_id'];

	$course_id = array(1001, 1002, 1003, 1004,1005,1006,1007,1008);
	$course_name = array("Data Structures", "Intorduction to computing", "Artificail Intelligence", "Database Management Systems","Machine Learning", "Computer Vision","Discrete Mathematics","Analysis and Design of Algorithm");
	$credits = array(1,2,3,4,5,6,7,8);
	

	/*

		Write your code here;


	*/

	// IF succesfull then $data->err = "OK";
	// ELSE if any error occur make $data->err = error message;
	
	$data = new stdClass();
	$data->err = "OK";
	$data->course_id = $course_id;
	$data->course_name = $course_name;
	$data->course_credit = $credits;

	echo json_encode($data);
?>