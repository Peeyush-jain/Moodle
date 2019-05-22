<?php

	// This is used to get list of all the current faculties.

	session_start();

	// $faculty_id is array of ids of the facultyes
	$faculty_id = array(101, 1025, 1034);

	// $faculty_name is array of names of the facultyes
	$faculty_name = array("CKN", "Gunturi", "Mukesh");

		/*

		Write your code here;


	*/



	// IF course is succesfully added then $data->err = "OK";
	// ELSE if any error occur make $data->err = error message;
	
	$data = new stdClass();
	$data->err = "OK";
	$data->faculty_id = $faculty_id;
	$data->faculty_name = $faculty_name;

	echo json_encode($data);
?>