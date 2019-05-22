<?php

	// This is used to get list of all the courses floated in this semester for all the students.

	session_start();

	// $course_id is array of ids of the courses
	$course_id = array(1001, 1025, 1034, 1097,2025,3036,4058,457);

	// $course_name is array of names of the courses
	$course_name = array("Data Structures", "Intorduction to computing", "Artificail Intelligence", "Database Management Systems","Machine Learning", "Computer Vision","Discrete Mathematics","Analysis and Design of Algorithm");

	$credits = array(4,3,2,1,1,2,3,4);
	$time_slot = array('A0','B0','C0','D0','A0','B0','C0','D0',);
	
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
	$data->time_slot = $time_slot;

	echo json_encode($data);
?>