<?php

	// This is used to get list of all the batches.

	session_start();

	// $batch_id is array of ids of the batches
	$batch_id = array(101, 1025, 1034);

	// $batch_name is array of names of the batches
	$batch_name = array("bcs15", "bcs16", "bcs14");

		/*

		Write your code here;


	*/



	// IF course is succesfully added then $data->err = "OK";
	// ELSE if any error occur make $data->err = error message;
	
	$data = new stdClass();
	$data->err = "OK";
	$data->batch_id = $batch_id;
	$data->batch_name = $batch_name;

	echo json_encode($data);
?>