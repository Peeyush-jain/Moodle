<?php
session_start();

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
					<div id="course">
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
						url: "server/credit_history.php",
						data:{
						},
						success: function(result){
							result = $.parseJSON(result);
							var element1 = document.getElementById('course');
							if(result['err']=='OK'){
								$('#course').show();
								total = result['category'].length;
								for(var j = 0;j<total;j++){
									var a = '<h5>' + result['category'][j] + ' - ' + result['total_credits'][j] +'</h5>';
									var b = '<table class="highlight"><thread><tr><th>Name</th><th>Credits</th></tr>';
									n = result['name'][j].length;
									var c = '';
									for(var i=0;i<n;i++){
										c += ('<tr><td><a href="' + 'course.php?id=' + result['id'][j][i] + '">' + result['name'][j][i] + '</a></td><td>' + result['credits'][j][i] + '</td></tr>');
									}
									element1.innerHTML += '<div class="myCard">' + a + b + c + '</table></div><br>';
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
		}
		else{

		}
	}
?>

</body>
</html>
