<?php
session_start();

$email = '';

if(isset($_GET['e'])){
	$email = $_GET['e'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	<title>Last Semester Performance | Moodle | IIT Ropar</title>
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
		if($_SESSION['type']=='faculty' || $_SESSION['type']=='dean' || $_SESSION['type']=='staff' || $_SESSION['type']=='hod' || $_SESSION['type']=='admin'){
		?>
			<div id="navbar-placeholder" class="navbar-fixed"></div>

			<div class="row" style="margin-top: 30px;margin-bottom: 20px;">
    			<div class="col l3"></div>
    			<div class="col l6 m12 s12">
    				
					<div id="error_message" class="myCard">
						<div id="error_message_content"></div>	
					</div>
					<div id="course" class="myCard">
						<div class="input-field col s12">
							<input placeholder="Student Email" id="email" type="email" class="validate" value= "<?php echo $email; ?>">
						</div>
						<div class="center">
						<button class="btn waves-effect waves-light light-blue darken-4" type="submit" name="action" id="submit">Submit
						<i class="material-icons right">send</i>
						</button>
						</div>
						<h4 class="center">All Semester Performance</h4>	
						<div id="details"></div>
						
						<table class="highlight">
							<tr>
							<th>Name</th>
							<th>Credits</th>
							<th>Grade</th>
							</tr>
							<tbody id="courses">
							</tbody>
						</table>
						<h5 id="cgpa"> CGPA: </h5>
	    			</div>
				</div>
			</div>

			<div id="footer-placeholder"></div>

			<script>
				$(document).ready(function(){
					$('#error_message').hide();
					$("#submit").click(function(){
						var y = $('#year :selected').val();
						var f = $('#fall :selected').val();
						var e = $('#email').val();
						var url = 'other-student-cumm-performance.php?'+'e='+e;
						$(location).attr('href',url);
					});
					var e = "<?php echo $email; ?>";
					if(e!=''){
						$.ajax({
							type:"POST",
							url: "server/other_all_sem_grades.php",
							data:{
								email: e
							},
							success: function(result){
								result = $.parseJSON(result);
								var element1 = document.getElementById('courses');
								console.log(result);
								if(result['err']=='OK'){
									$('#enroll_course_list').show();
									var n = result['course_id'].length;
									for(i=0;i<n;i++){
										element1.innerHTML += ('<tr>'+'<td>' + '<a href="course.php?id=' + result['course_id'][i] + '">' + result['course_name'][i] + '</a>' + '</td>'
										+'<td>' + result["credit"][i] +'</td>'
										+'<td>' + result["grade"][i] +'</td>'
										+'</tr>');
									}
									var element2 = document.getElementById('cgpa');
									element2.innerHTML += result['cgpa'];
									var element3 = document.getElementById('details');
									element3.innerHTML += "Name : " + result['name'] + '<br>';
									element3.innerHTML += "Entry No. : " + result['entry'] + '<br>';
								}
								else{
									$('#course').hide();
									$('#error_message').show();
									var element2 = document.getElementById('error_message_content');
									element2.innerHTML = result['err'];
								}
							}
						});	
					}
					else{
						$('#error_message').show();
						var element2 = document.getElementById('error_message_content');
						element2.innerHTML = 'Enter all the details';
					}
					
				});
			</script>
		<?php
		}
		else{

		}
		if($_SESSION['type'] == 'faculty'){
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
?>


<!--  Scripts-->

</body>
</html>
