<?php
session_start();
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
		if($_SESSION['type'] == 'student'){
		?>
			<div id="navbar-placeholder" class="navbar-fixed"></div>

			<div class="row" style="margin-top: 30px;margin-bottom: 20px;">
    			<div class="col l3"></div>
    			<div class="col l6 m12 s12">
					<div id="error_message" class="card-panel teal lighten-2" style="margin-bottom: 300px;">
						<div id="error_message_content" class="card-content white-text"></div>	
					</div>
					<div id="ticket"></div>
					
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
						url: "server/ticket_status.php",
						data:{
						},
						success: function(result){
							result = $.parseJSON(result);
							var element1 = document.getElementById('ticket');
							if(result['err']=='OK'){
								var n = result['course'].length;
								for(var i = 0;i<n;i++){
									var s = '<div class="myCard">' + '<h5>' + result['course'][i] + '</h5>'
									+ result['content'] + '</div>' + '<br>'
									;
									element1.innerHTML += s;
								}
							}
							else{
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


<!--  Scripts-->

</body>
</html>
