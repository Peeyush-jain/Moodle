<?php

	// This is used to get list of all the courses in currrent semester


	session_start();

	$course_id = array(1001, 1025, 1034, 1097,2025,3036,4058,457);
	$course_name = array("Data Structures", "Intorduction to computing", "Artificail Intelligence", "Database Management Systems","Machine Learning", "Computer Vision","Discrete Mathematics","Analysis and Design of Algorithm");
	$credits = array(1,2,3,4,5,6,7,8);
	$time_slot = array('A','B','A','C','A','B','A','C');
	
	$data = new stdClass();
	$data->err = "OK";
	$data->course_id = $course_id;
	$data->course_name = $course_name;
	$data->course_credit = $credits;
	$data->time_slot = $time_slot;

	echo json_encode($data);
?>