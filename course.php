<?php
session_start();
$_SESSION['type'] = 'student';
$_SESSION['user_id'] = 5;

$course_id = -1;

if(isset($_GET['id'])){
	$course_id = $_GET['id'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	<title>Course Details | IIT Ropar</title>
	<link rel="shortcut icon" type="image" href="static/img/title_icon.png"/>
	<!-- CSS  -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="static/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="static/css/mystyle.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="static/js/materialize.js"></script>
</head>
<body>

<?php
	if(!isset($_SESSION['type'])){
	?>

	<?php
	}
	else{
		if($_SESSION['type'] == 'student'){
		?>
			<div id="navbar-placeholder" class="navbar-fixed"></div>

			<div class="row" style="margin-top: 30px;margin-bottom: 20px;">
    			<div class="col l3"></div>
    			<div class="col l6 m12 s12">
					<div id="error_message" class="card" style="margin-bottom: 300px;">
						<div id="error_message_content" class="card-content"></div>
					</div>
					<div id="course" class="myCard">
	    			</div>
				</div>
			</div>

			<div id="footer-placeholder"></div>

			<script>
				$(document).ready(function(){
					$("#navbar-placeholder").load("static/include/student_navbar.html");
					$("#footer-placeholder").load("static/include/student_footer.html");
					$('#error_message').hide();
					var id =  "<?php  echo $course_id;  ?>";
					$.ajax({
						type:"POST",
						url: "server/course_detail.php",
						data:{
							course_id : id
						},
						success: function(result){
							result = $.parseJSON(result);
							var element1 = document.getElementById('course');
							if(result['err']=='OK'){
								$('#course').show();
								element1.innerHTML += '<h5>' + result['name'] + '</h5>';
								element1.innerHTML += '<h5>(L-T-P) : ' + result['l'] + '-' + result['t'] + '-' + result['p'] + '</h5>';
								n = result['pre'].length;
								element1.innerHTML += '<h6 style="display:inline-block;">Pre-requisites:&nbsp;';
								for(var i=0;i<n;i++){
									element1.innerHTML += ('<a href="' + 'course.php?id=' + result["pre_id"][i] + '">' + result['pre'][i] + '</a>, ');
								}
								element1.innerHTML += '</h6>';
								element1.innerHTML += '<p>' + result['description'] + '</p>';
							}
							else{
								$('#course').hide();
								$('#error_message').show();
								var element2 = document.getElementById('error_message_content');
								element2.innerHTML = result['err'];
							}
						}
					});
				});
			</script>
		<?php
		}
		else{

		}
	}
?>

</body>
</html>
