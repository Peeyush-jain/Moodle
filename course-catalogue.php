<?php
session_start();

$page = 1;

if(isset($_GET['page'])){
	$page = $_GET['page'];
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
		if($_SESSION['type']=='student' || $_SESSION['type']=='faculty' || $_SESSION['type']=='dean' || $_SESSION['type']=='staff' || $_SESSION['type']=='hod' || $_SESSION['type']=='admin'){
		?>
			<div id="navbar-placeholder" class="navbar-fixed"></div>

			<div class="row" style="margin-top: 30px;margin-bottom: 20px;">
    			<div class="col l3"></div>
    			<div class="col l6 m12 s12">
					<div id="error_message" class="card" style="margin-bottom: 300px;">
						<div id="error_message_content" class="card-content"></div>
					</div>
					<div id="course">
						<div class="center">
							<?php if($page > 1){
								echo '<a href="course-catalogue.php?page='. ($page-1) .'"><i class="medium material-icons" style="color: #2196f3;">arrow_backward</i></a>';
							}
		    				echo '<a href="course-catalogue.php?page='. ($page+1) .'"><i class="medium material-icons" style="color: #2196f3;">arrow_forward</i></a>';
		    			?>
		    			</div>
	    			</div>
				</div>
			</div>

			<div id="footer-placeholder"></div>

			<script>
				$(document).ready(function(){
					$("#navbar-placeholder").load("static/include/student_navbar.html");
					$("#footer-placeholder").load("static/include/student_footer.html");
					$('#error_message').hide();
					var id =  "<?php  echo $page;  ?>";
					$.ajax({
						type:"POST",
						url: "server/course_catalogue.php",
						data:{
							page : id
						},
						success: function(result){
							result = $.parseJSON(result);
							var element1 = document.getElementById('course');
							if(result['err']=='OK'){
								$('#course').show();
								total = result['name'].length;
								for(var j = 0;j<total;j++){
									n = result['pre'][j].length;
									var ss = '';
									for(var i=0;i<n;i++){
										ss += ('<a href="' + 'course.php?id=' + result["pre_id"][j][i] + '">' + result['pre'][j][i] + '</a>, ');
									}
									element1.innerHTML += '<div class="myCard">' + '<h5>' + result['name'][j] + '</h5>' + '<h5>(L-T-P) : ' + result['l'][j] + '-' + result['t'][j] + '-' + result['p'][j] + '</h5>' + '<h6 style="display:inline-block;">Pre-requisites:&nbsp;' + ss + '</h6>' + '<p>' + result['description'][j] + '</p>'  +'</div>' + '<br>';
								}
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
