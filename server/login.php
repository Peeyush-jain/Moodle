<?php
    
	require('dbconnect.php');
    session_start();

    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $data = new stdClass();
    $data->err = "true";
    $data->id = 0;
      

    if($email==''){
        $data->err= "username field is empty";
    }
    else if($password==''){
        $data->err = "password field is empty";
    }
    
    else {    

        $sql = "SELECT * FROM students WHERE email='$email' AND password='$password' AND isdelete = 0";
		$res = mysqli_query($conn,$sql);

		$found = 0;
            
        if($res){
        	if($row=$res->fetch_assoc()){
        		$_SESSION['type'] = 'student';
        		$found = 1;
        		$data->err = 'OK';
        		$_SESSION['user_id'] = $row['student_id'];
        		$_SESSION['name'] = $row['name'];
        		$_SESSION['email'] = $row['email'];
        		$_SESSION['batch_id'] = $row['batch_id'];
        	}
        }

        if($found == 0){
	        $sql = "SELECT * FROM faculty WHERE email='$email' AND password='$password' AND isdelete = 0";
			$res1 = mysqli_query($conn,$sql);
	            
	        if($res1){
	        	if($row=$res1->fetch_assoc()){
	        		$found = 1;
	        		$_SESSION['type'] = 'faculty';
	        		$data->err = 'OK';
	        		$_SESSION['user_id'] = $row['faculty_id'];
	        		$_SESSION['name'] = $row['name'];
	        		$_SESSION['email'] = $row['email'];
	        		$_SESSION['department_id'] = $row['department_id'];
	        	}
	        }
        }

        if($found == 0){
	        $sql = "SELECT * FROM hod_office WHERE email='$email' AND password='$password' AND isdelete = 0";
			$res2 = mysqli_query($conn,$sql);
	        
	        if($res2){
	        	if($row=$res2->fetch_assoc()){
	        		$found = 1;
	        	
	        		$_SESSION['type'] = 'hod';
	        		$data->err = 'OK';
	        		$_SESSION['user_id'] = $row['faculty_id'];

	        		$faculty_id = $row['faculty_id'];

	        		$sql = "SELECT * FROM faculty WHERE faculty_id = $faculty_id AND isdelete=0";
	        		$res3 = mysqli_query($conn,$sql);
	        		$row1 = $res3->fetch_assoc();
	        		$_SESSION['name'] = $row1['name'];
	        		$_SESSION['email'] = $row['email'];
	        		$_SESSION['department_id'] = $row['department_id'];
	        	}
	        }
        }

        if($found == 0){
        	$sql = "SELECT * FROM staff_dean WHERE email='$email' AND password='$password' AND isdelete = 0";
			$res4 = mysqli_query($conn,$sql);
	        if($res4){
	        	if($row=$res4->fetch_assoc()){
	        		$found = 1;
	        		$_SESSION['type'] = 'staff';
	        		$data->err = 'OK';
	        		$_SESSION['user_id'] = $row['staff_id'];
	        		$_SESSION['name'] = $row['name'];
	        		$_SESSION['email'] = $row['email'];
	        	}
	        }
        }

        if($found == 0){
	        $sql = "SELECT * FROM dean WHERE email='$email' AND password='$password' AND isdelete = 0";
			$res5 = mysqli_query($conn,$sql);
	            
	        if($res5){
	        	if($row=$res5->fetch_assoc()){
	        		$found = 1;
	        		$_SESSION['type'] = 'dean';
	        		$data->err = 'OK';
	        		$_SESSION['user_id'] = $row['faculty_id'];
	        		$faculty_id = $row['faculty_id'];
	        		$sql = "SELECT * FROM faculty WHERE faculty_id = $faculty_id AND isdelete=0";
	        		$res6 = mysqli_query($conn,$sql);
	        		$row1 = $res6->fetch_assoc();
	        		$_SESSION['name'] = $row1['name'];

	        		$_SESSION['email'] = $row['email'];
	        	}
	        }
        }

        if($found == 0){
	        $sql = "SELECT * FROM admin WHERE email='$email' AND password='$password' AND isdelete = 0";
			$res7 = mysqli_query($conn,$sql);
	            
	        if($res7){
	        	if($row=$res7->fetch_assoc()){
	        		$found = 1;
	        		$_SESSION['type'] = 'admin';
	        		$data->err = 'OK';
	        		$_SESSION['user_id'] = $row['admin_id'];
	        		$_SESSION['name'] = $row['name'];
	        		$_SESSION['email'] = $row['email'];
	        	}
	        }
        }

        if($found==0){
        	$data->err = "Invalid email or password";
        }
    }
   
    $myJSON = json_encode($data);
    echo $myJSON;
?>
