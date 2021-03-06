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
		if($_SESSION['type'] == 'admin'){
			?>

			<div id="navbar-placeholder" class="navbar-fixed"></div>

			<div class="row" style="margin-top: 30px;margin-bottom: 20px;">
    			<div class="col l3"></div>
    			<div class="col l6 m12 s12 center">
    				<div id="error_message" class="myCard">
						<div id="error_message_content"></div>
					</div>
    				<div class="myCard">
	    				<h4>Delete Student</h4>
						<input placeholder="Email of faculty" id="email" type="email" class="validate">
						<button class="btn waves-effect waves-light light-blue darken-4" id="submit">Submit<i class="material-icons right">send</i></button>
				</div>
				</div>
			</div>


			<div id="footer-placeholder"></div>

			<script>
				$(document).ready(function(){
					$("#navbar-placeholder").load("static/include/admin_navbar.html");
					$("#footer-placeholder").load("static/include/faculty_footer.html");
					$('#error_message').hide();
					$("#submit").click(function(){
						var email = $('#email').val();
						if(email == ''){
							$('#error_message').show();
							var element2 = document.getElementById('error_message_content');
							element2.innerHTML = 'Enter email';
						}
						else{
							$.ajax({
								type:"POST",
								url: "server/admin_delete_faculty.php",
								data:{
									email: email
								},
								success: function(result){
									result = $.parseJSON(result);
									$('#error_message').show();
									var element2 = document.getElementById('error_message_content');
									if(result['err']=='OK'){
										element2.innerHTML = 'Faculty Deleted succesfully';
									}
									else{
										element2.innerHTML = result['err'];
									}
								}
							});
						}
					});
				});
			</script>
			<?php
		}
	}
?>

</body>
</html>
