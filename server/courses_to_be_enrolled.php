<?php


	// This is used to get list of courses that has been floated for a student but not yet enrolled by that student

	session_start();
	// user_id can be accessed using $_SESSION['user_id'];
	// $user_id = $_SESSION['user_id'];

	/*

		Write your code here;


	*/



	// IF succesfull then $data->err = "OK";
	// ELSE if any error occur make $data->err = error message;

	
	$data = new stdClass();
	$data->err = "OK";
	$data->course_name = array("Digital Image Analysis","Computer Networks");
	$data->course_id = array(1041,1052);
	$data->l = array(3,4);
	$data->t = array(0,1);
	$data->p = array(2,1.5);
	$data->slot = array('A','B');

	echo json_encode($data);
?>