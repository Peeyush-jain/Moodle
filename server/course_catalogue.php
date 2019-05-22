<?php


	// This is used to get course strucuture and pre-requisites of all the courses for course catalogue.php

	session_start();
	// $user_id = $_SESSION['user_id'];
	// user_id can be accessed using $_SESSION['user_id'];

	// Page id can be found from $_POST['page']
	// $_page = $_POST['page'];

	// for page = 1, send 1-10 courses
	// for page = 2, send 11-20 courses
	// for page = 3, send 21-30 courses


	/*

		Write your code here;


	*/



	// IF succesfull then $data->err = "OK";
	// ELSE if any error occur make $data->err = error message;

	
	$data = new stdClass();
	$data->err = "OK";
	$data->name = array("Artificial Intelligence","Data Strucutres");
	$data->l = array(3,2);
	$data->t = array(0,1);
	$data->p = array(1,2);
	$data->pre = array(array('Introduction to Computing','Data Structures'),array('Artificial Intelligence','Machine learning'));
	$data->pre_id = array(array(1034,2057),array(2015,7541));
	$data->description = array('Course Content: Problem solving, search techniques, control operating environment; practical and strategies, game playing (mini-max), reasoning, implementation issues in run-time systems and knowledge representation through predicate logic, environment; abstract machines; features of rule-based systems, semantic nets, frames, functional and imperative languages. The untyped conceptual dependency formalism, Planning. and simply-typed Lambda calculus, type systems Handling uncertainty: Bayesian Networks, for programming languages including simple types Dempster-Shafer theory, certainty factors, Fuzzy and polymorphism; objects; classes and logic, Learning through Neural nets — Back inheritance in object-oriented propagation, radial basis functions, Neural computational models - Hopfield','COurse Content: Some text here');

	echo json_encode($data);
?>