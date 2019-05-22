<?php

	// This is used to get list of all the courses present in the course catalogue.

	session_start();

	// $course_id is array of ids of the courses
	$course_id = array(1001, 1002, 1034, 1097,2025,3036,4058,457);

	// $course_name is array of names of the courses
	$course_name = array("Data Structures", "Intorduction to computing", "Artificail Intelligence", "Database Management Systems","Machine Learning", "Computer Vision","Discrete Mathematics","Analysis and Design of Algorithm");

	/*

		Write your code here;


	*/



	// IF course is succesfully added then $data->err = "OK";
	// ELSE if any error occur make $data->err = error message;
	
	$data = new stdClass();
	$data->err = "OK";
	$data->course_id = $course_id;
	$data->course_name = $course_name;

	echo json_encode($data);
?>