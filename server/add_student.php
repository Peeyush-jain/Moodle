<?php
session_start();

$_FILES["fileToUpload"]["name"] = round(microtime(true)) . '.csv';
$dir = "../uploads/";
$file = $dir.basename($_FILES["fileToUpload"]["name"]);
$file_name = $dir.$_FILES["fileToUpload"]["name"];

$err = "OK";

// Check file size
if($_FILES["fileToUpload"]["size"] > 1000){
	$err = "Sorry, your file is too large.";
}
else{
	if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $file)) {
		
		$file = fopen($file_name,"r");
		while (!feof($file)){
			$arr = fgetcsv($file);
			mysqli_query($con, "INSERT INTO students VALUES (". $arr[0]. ", ". $arr[1]. ", ". $arr[2]. ", '". $arr[3]. "', '". $arr[4]. "', 0, 0)");
		}
		fclose($file);
	}
	else{
		$err = "Sorry, there was an error uploading your file.";
	}
}

$data = new stdClass();
echo json_encode($data);

?>