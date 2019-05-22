<?php

	// This is used to get list of all the current departments.

	session_start();

	// $department_id is array of ids of the departmentes
	$department_id = array(101, 1025, 1034);

	// $department_name is array of names of the departmentes
	$department_name = array("CS", "EE", "ME");

		/*

		Write your code here;


	*/



	// IF course is succesfully added then $data->err = "OK";
	// ELSE if any error occur make $data->err = error message;
	
	$data = new stdClass();
	$data->err = "OK";
	$data->department_id = $department_id;
	$data->department_name = $department_name;

	echo json_encode($data);
?>