<?php


	// This is used to get courses a user has already done

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
	$data->category = array("Program Core","Program Elective","Science Elective","Other");

	$data->name = array(array("Computer Networks","Data Strucutres"),array("Machine Learning","Artificial Intelligence"),array("Numerical Analysis","Physics of Material"),array("Management","Finance"));
	$data->id = array(array(1054,1037),array(1034,1078),array(1054,1037),array(1034,1078));
	$data->credits = array(array(4,5.5),array(4,3),array(3,4),array(1.5,3));
	$data->total_credits = array(9.5,7,7,4.5);

	echo json_encode($data);
?>