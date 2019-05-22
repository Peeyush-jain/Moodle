<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	<title>Moodle | IIT Ropar</title>
	<link rel="shortcut icon" type="image" href="static/img/title_icon.png"/>
	<!-- CSS  -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="static/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="static/css/mystyle.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<style>
	</style>
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
		if($_SESSION['type']=='student' || $_SESSION['type']=='faculty' || $_SESSION['type']=='dean' || $_SESSION['type']=='staff' || $_SESSION['type']=='hod' || $_SESSION['type']=='admin'){
		?>
		<div id="navbar-placeholder" class="navbar-fixed"></div>

		<div class="row" style="margin-top: 30px;margin-bottom: 20px;">
			<div class="col l3"></div>
			<div class="col l6 m12 s12">
				<div id="error_message" class="card" style="margin-bottom: 300px;">
					<div id="error_message_content" class="card-content"></div>
				</div>
				<div id="course_list" class="myCard">
					<h4 class="center">Currently Floated Courses</h4>
					<table class="highlight">
						<thead>
				          <tr>
				              <th>Name</th>
				              <th>Credits</th>
				              <th>Time Slot</th>
				          </tr>
				        </thead>
						<tbody id="courses">
						</tbody>
					</table>
    			</div>
			</div>
		</div>

		<div id="footer-placeholder"></div>

		<script>
			$(document).ready(function(){
				$('#error_message').hide();
				$.ajax({
					type:"POST",
					url: "server/all_current_course_list.php",
					data:{
					},
					success: function(result){
						result = $.parseJSON(result);
						var element1 = document.getElementById('courses');
						if(result['err']=='OK'){
							$('#course_list').show();
							var n = result['course_id'].length;
							for(i=0;i<n;i++){
								element1.innerHTML += ('<tr><td><a href="course.php?id=' + result['course_id'][i] + '">' + result['course_name'][i] + '</a></td><td>'+ result['course_credit'][i] +'</td>' +'<td>'+ result['time_slot'][i] +'</td></tr>'); 
							}
						}
						else{
							$('#course_list').hide();
							$('#error_message').show();
							var element2 = document.getElementById('error_message_content');
							element2.innerHTML = result['err'];
						}
					}
				});
			});
		</script>
		<?php
		if($_SESSION['type'] == 'student'){
		?>
			<script>
				$(document).ready(function(){
					$("#navbar-placeholder").load("static/include/student_navbar.html");
					$("#footer-placeholder").load("static/include/student_footer.html");
				});
			</script>
		<?php
		}
		elseif($_SESSION['type'] == 'faculty'){
			?>
				<script>
					$(document).ready(function(){
						$("#navbar-placeholder").load("static/include/faculty_navbar.html");
						$("#footer-placeholder").load("static/include/faculty_footer.html");
					});
				</script>
			<?php
		}
		elseif($_SESSION['type'] == 'staff'){
			?>
				<script>
					$(document).ready(function(){
						$("#navbar-placeholder").load("static/include/staff_navbar.html");
						$("#footer-placeholder").load("static/include/staff_footer.html");
					});
				</script>
			<?php
		}
		elseif($_SESSION['type'] == 'dean'){
			?>
				<script>
					$(document).ready(function(){
						$("#navbar-placeholder").load("static/include/dean_navbar.html");
						$("#footer-placeholder").load("static/include/dean_footer.html");
					});
				</script>
			<?php
		}
		elseif($_SESSION['type'] == 'hod'){
			?>
				<script>
					$(document).ready(function(){
						$("#navbar-placeholder").load("static/include/hod_navbar.html");
						$("#footer-placeholder").load("static/include/hod_footer.html");
					});
				</script>
			<?php
		}
		elseif($_SESSION['type'] == 'admin'){
			?>
				<script>
					$(document).ready(function(){
						$("#navbar-placeholder").load("static/include/admin_navbar.html");
						$("#footer-placeholder").load("static/include/admin_footer.html");
					});
				</script>
			<?php
		}
		}
	}	
?>

</body>
</html>
