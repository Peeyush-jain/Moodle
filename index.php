<?php
session_start();
$_SESSION['type'] = 'student';
// $_SESSION['type'] = 'faculty';
// $_SESSION['type'] = 'hod';
// $_SESSION['type'] = 'staff';
// $_SESSION['type'] = 'dean';
// $_SESSION['type'] = 'admin';


$_SESSION['name'] = 'Pratik Chhajer';
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

	<div class="row" style="margin-top: 30px;margin-bottom: 20px;">
		<div class="col l3"></div>
		<div class="col l6 m12 s12">
			<div style="margin-top: 20px;"></div>
			<div id="error_message" class="myCard">
				<div id="error_message_content"></div>
			</div>
			<div class="myCard center" style="padding-bottom: 60px;">
				<input placeholder="Email" id="email" type="email" class="validate">
				<input placeholder="Password" id="password" type="password" class="validate">
				<button class="btn waves-effect waves-light light-blue darken-4" type="submit" name="action" id="submit" style="margin-top: 20px;">Submit<i class="material-icons right">send</i></button>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function(){
			$('#error_message').hide();
		});
		$("#submit").click(function(){
			var email = $('#email').val();
			var password = $('#password').val();
			if(email == '' || password == ''){
				$('#error_message').show();
				var element2 = document.getElementById('error_message_content');
				element2.innerHTML = 'Enter all the details';
			}
			else{
				$.ajax({
					type:"POST",
					url: "server/login.php",
					data:{
						email: email,
						password: password
					},
					success: function(result){
						result = $.parseJSON(result);
						$('#error_message').show();
						var element2 = document.getElementById('error_message_content');
						if(result['err']!='OK'){
							element2.innerHTML = result['err'];
						}
						else{
							$(location).attr('href', 'index.php');
						}
					}
				});
			}
		});
	</script>

	<?php
	}
	else{
		if($_SESSION['type'] == 'student'){
		?>
			<div id="navbar-placeholder" class="navbar-fixed"></div>

			<div class="row" style="margin-top: 30px;margin-bottom: 20px;">
    			<div class="col l3"></div>
    			<div class="col l6 m12 s12">
    				<h3 class="center">Welcome <?php echo $_SESSION['name']; ?></h3>
					<div id="error_message" class="myCard">
						<div id="error_message_content"></div>
					</div>
					<div id="course_list" class="myCard">
						<h4 class="center">My Courses</h4>
						<table class="highlight">
							<tbody id="courses">
							</tbody>
						</table>
	    			</div>
				</div>
			</div>

			<div id="footer-placeholder"></div>

			<script>
				$(document).ready(function(){
					$("#navbar-placeholder").load("static/include/student_navbar.html");
					$("#footer-placeholder").load("static/include/student_footer.html");
					$('#error_message').hide();
					$.ajax({
						type:"POST",
						url: "server/current_course_list.php",
						data:{
						},
						success: function(result){
							result = $.parseJSON(result);
							var element1 = document.getElementById('courses');
							if(result['err']=='OK'){
								$('#course_list').show();
								var n = result['course_id'].length;
								for(i=0;i<n;i++){
									element1.innerHTML += ('<tr><td><a href="course.php?id=' + result['course_id'][i] + '">' + result['course_name'][i] + '</a></td></tr>'); 
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
		}
		elseif($_SESSION['type'] == 'faculty'){
			?>

			<div id="navbar-placeholder" class="navbar-fixed"></div>

			<div class="row" style="margin-top: 30px;margin-bottom: 20px;">
    			<div class="col l3"></div>
    			<div class="col l6 m12 s12">
    				<h3 class="center">Welcome <?php echo $_SESSION['name']; ?></h3>
					<div id="error_message" class="myCard">
						<div id="error_message_content"></div>
					</div>
					<div id="course_list" class="myCard">
						<h4 class="center">My Courses</h4>
						<table class="highlight">
							<tbody id="courses">
							</tbody>
						</table>
	    			</div>
				</div>
			</div>


			<div id="footer-placeholder"></div>

			<script>
				$(document).ready(function(){
					$("#navbar-placeholder").load("static/include/faculty_navbar.html");
					$("#footer-placeholder").load("static/include/faculty_footer.html");
					$('#error_message').hide();
					$.ajax({
						type:"POST",
						url: "server/current_faculty_course_list.php",
						data:{
						},
						success: function(result){
							result = $.parseJSON(result);
							var element1 = document.getElementById('courses');
							if(result['err']=='OK'){
								$('#course_list').show();
								var n = result['course_id'].length;
								for(i=0;i<n;i++){
									element1.innerHTML += ('<tr><td><a href="faculty-course.php?id=' + result['course_id'][i] + '">' + result['course_name'][i] + '</a></td></tr>'); 
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
		}
		elseif($_SESSION['type'] == 'hod'){
			?>

			<div id="navbar-placeholder" class="navbar-fixed"></div>

			<h3 class="center" style="margin-bottom: 200px;">Welcome <?php echo $_SESSION['name']; ?></h3>

			<div id="footer-placeholder"></div>

			<script>
				$(document).ready(function(){
					$("#navbar-placeholder").load("static/include/hod_navbar.html");
					$("#footer-placeholder").load("static/include/hod_footer.html");
				});
			</script>
			<?php
		}
		elseif($_SESSION['type'] == 'staff'){
			?>

			<div id="navbar-placeholder" class="navbar-fixed"></div>

			<h3 class="center" style="margin-bottom: 200px;">Welcome <?php echo $_SESSION['name']; ?></h3>

			<div id="footer-placeholder"></div>

			<script>
				$(document).ready(function(){
					$("#navbar-placeholder").load("static/include/staff_navbar.html");
					$("#footer-placeholder").load("static/include/staff_footer.html");
				});
			</script>
			<?php
		}
		elseif($_SESSION['type'] == 'admin'){
			?>

			<div id="navbar-placeholder" class="navbar-fixed"></div>

			<div class="row" style="margin-top: 30px;margin-bottom: 20px;">
    			<div class="col l3"></div>
    			<div class="col l6 m12 s12">
    				<h3 class="center" style="margin-bottom: 20px;">Welcome <?php echo $_SESSION['name']; ?></h3>

					<div id="list" class="myCard">
						<table class="highlight">
							<tbody id="courses">
								<tr><td><a href="admin-add-student.php">Add Students</a></td></tr>
								<tr><td><a href="admin-add-faculty.php">Add Faculty</a></td></tr>
								<tr><td><a href="admin-add-staff.php">Add Staff Member</a></td></tr>
								<tr><td><a href="admin-add-department.php">Add Department</a></td></tr>
								<tr><td><a href="admin-add-time-slot.php">Add time slot</a></td></tr>
								<tr><td><a href="admin-update-hod.php">Update hod</a></td></tr>
								<tr><td><a href="admin-update-dean.php">Update Dean</a></td></tr>
								<tr><td><a href="admin-delete-student.php">Delete Student</a></td></tr>
								<tr><td><a href="admin-delete-faculty.php">Delete Faculty</a></td></tr>
								<tr><td><a href="admin-delete-staff.php">Delete Staff</a></td></tr>
							</tbody>
						</table>
	    			</div>
				</div>
			</div>


			<div id="footer-placeholder"></div>

			<script>
				$(document).ready(function(){
					$("#navbar-placeholder").load("static/include/admin_navbar.html");
					$("#footer-placeholder").load("static/include/admin_footer.html");
					
				});
			</script>
			<?php
		}
		elseif($_SESSION['type'] == 'dean'){
			?>

			<div id="navbar-placeholder" class="navbar-fixed"></div>

			<h3 class="center" style="margin-bottom: 20px;">Welcome <?php echo $_SESSION['name']; ?></h3>

			<div id="footer-placeholder"></div>

			<script>
				$(document).ready(function(){
					$("#navbar-placeholder").load("static/include/dean_navbar.html");
					$("#footer-placeholder").load("static/include/dean_footer.html");
				});
			</script>
			<?php
		}
	}
?>

</body>
</html>
