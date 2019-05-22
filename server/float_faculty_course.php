<?php


	// This is used to float a new course by faculty.


	session_start();
	// user_id can be accessed using $_SESSION['user_id'];

	$course_id = $_POST['course_id'];
	// $batch_ids = $_POST['batch_ids']; Array
	// $faculty_ids =  $_POST['faculty_ids']; Array
	// $pre_ids = $_POST['pre_ids']; Array
	// $cgpa = $_POST['cgpa']; Array
	// $time_slot = $_POST[time_slot]; Array
	// pre_cg =  $_POST['pre_cg']; Array

	
	$data = new stdClass();
	$data->err = "OK";

	echo json_encode($data);
?>