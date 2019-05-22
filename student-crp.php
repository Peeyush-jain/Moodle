<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	<title>CRP | Add Course | Moodle | IIT Ropar</title>
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
    				<?php
						if(isset($_GET['message'])){
							echo '<div id="message_content" class="myCard">';
							echo $_GET['message'];
							echo '</div>';
						}
					?>
					<div id="error_message" class="card-panel teal lighten-2" style="margin-bottom: 300px;">
						<div id="error_message_content" class="card-content white-text"></div>	
					</div>
					<div id="enrol_course_list" class="myCard">
						<h6>Courses you haven't enrolled yet</h6>
						<table class="highlight">
							<tr>
							<th>Name</th>
							<th>L</th>
							<th>T</th>
							<th>P</th>
							<th>Slot</th>
							</tr>
							<tbody id="enroll_courses">
							</tbody>
						</table>
	    			</div>
	    		<br>
					<div id="course_list" class="myCard">
						<div class="input-field col s12 center">
						    <select id="course_to_add">
						      <option value="0" disabled selected>Choose Course</option>
						    </select>
						    <label>Select Course to Register</label>
						    <button class="btn waves-effect waves-light light-blue darken-4" type="submit" name="action" id="submit">Submit
							    <i class="material-icons right">send</i>
							</button>
						  </div>
						<h6>Courses you have already enrolled</h6>
						<table class="highlight">
							<tr>
							<th>Name</th>
							<th>Credits</th>
							</tr>
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
					
					$("#navbar").removeClass();
					$("#navbar").addClass('orangeNav');
					$.ajax({
						type:"POST",
						url: "server/courses_to_be_enrolled.php",
						data:{
						},
						success: function(result){
							result = $.parseJSON(result);
							var element1 = document.getElementById('enroll_courses');
							console.log(result);
							if(result['err']=='OK'){
								$('#enroll_course_list').show();
								var n = result['course_id'].length;
								for(i=0;i<n;i++){
									element1.innerHTML += ('<tr>'+'<td>' + '<a href="course.php?id=' + result['course_id'][i] + '">' + result['course_name'][i] + '</a>' + '</td>'
									+'<td>' + result["l"][i] +'</td>'
									+'<td>' + result["t"][i] +'</td>'
									+'<td>' + result["p"][i] +'</td>'
									+'<td>' + result["slot"][i] +'</td>'
									+'</tr>');
								}
								// element1.innerHTML += ('<tr><td><b>' + 'Total' + '</br></td><td><b>'+ c +'</b></tr>');
							}
							else{
								$('#enroll_course_list').hide();
								$('#error_message').show();
								var element2 = document.getElementById('error_message_content');
								element2.innerHTML = result['err'];
							}
						}
					});
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
								var c = 0;
								for(i=0;i<n;i++){
									element1.innerHTML += ('<tr><td><a href="course.php?id=' + result['course_id'][i] + '">' + result['course_name'][i] + '</a></td><td>'+ result['course_credit'][i] +'</tr>');
									c += result['course_credit'][i]; 
								}
								element1.innerHTML += ('<tr><td><b>' + 'Total' + '</br></td><td><b>'+ c +'</b></tr>');
							}
							else{
								$('#course_list').hide();
								$('#error_message').show();
								var element2 = document.getElementById('error_message_content');
								element2.innerHTML = result['err'];
							}
						}
					});
					$.ajax({
						type:"POST",
						url: "server/all_current_course_list.php",
						data:{
						},
						success: function(result){
							result = $.parseJSON(result);
							console.log(result);
							var element2 = document.getElementById('course_to_add');
							console.log(element2);
							if(result['err']=='OK'){
								var n = result['course_id'].length;
								for(i=0;i<n;i++){
									console.log(('<option value="'+ result['course_id'][i] +'">' + result['course_name'][i] + '</option>'));
									element2.innerHTML += ('<option value="'+ result['course_id'][i] +'">' + result['course_name'][i] + '</option>'); 
								}
								$('select').formSelect();
							}
							else{
								$('#course_list').hide();
								$('#error_message').show();
								var element2 = document.getElementById('error_message_content');
								element2.innerHTML = result['err'];
							}
						}
					});
					$("#submit").click(function(){
						var course_id = $('#course_to_add :selected').val();
						var course_name = $('#course_to_add :selected').text();
						if(course_id==0){
							alert("No course selected");
						}
						else{
							$.ajax({
								type:"POST",
								url: "server/add_student_course.php",
								data:{
									course_id
								},
								success: function(result){
									result = $.parseJSON(result);
									if(result['err']=='OK'){
										location.href = 'student-crp.php?message=' + course_name + ' Registered Succesfully';
									}
									else{
										location.href = 'student-crp.php?message=' + result["err"];
									}
									
								}
							});
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
