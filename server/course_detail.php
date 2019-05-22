<?php


	// This is used to get course strucuture and pre-requisites of any course

	session_start();
	
	// $course_id can be accesses using below
	// $course_id = $_POST['course_id'];

	/*

		Write your code here;


	*/



	// IF succesfull then $data->err = "OK";
	// ELSE if any error occur make $data->err = error message;
	
	$data = new stdClass();
	$data->err = "OK";
	$data->name = "Artificial Intelligence";
	$data->l = 3;
	$data->t = 0;
	$data->p = 1;
	$data->pre = array("Data Structures", "Intorduction to computing");
	$data->pre_id = array(1001,1002);
	$data->description = 'Course Content: Problem solving, search techniques, control operating environment; practical and strategies, game playing (mini-max), reasoning, implementation issues in run-time systems and knowledge representation through predicate logic, environment; abstract machines; features of rule-based systems, semantic nets, frames, functional and imperative languages. The untyped conceptual dependency formalism, Planning. and simply-typed Lambda calculus, type systems Handling uncertainty: Bayesian Networks, for programming languages including simple types Dempster-Shafer theory, certainty factors, Fuzzy and polymorphism; objects; classes and logic, Learning through Neural nets — Back inheritance in object-oriented propagation, radial basis functions, Neural computational models - Hopfield';

	echo json_encode($data);
?>