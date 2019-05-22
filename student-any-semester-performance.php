<?php
session_start();

$year = -1;
$fall = -1;

if(isset($_GET['year'])){
	$year = $_GET['year'];
}

if(isset($_GET['fall'])){
	$fall = $_GET['fall'];
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
		if($_SESSION['type'] == 'student'){
		?>
			<div id="navbar-placeholder" class="navbar-fixed"></div>

			<div class="row" style="margin-top: 30px;margin-bottom: 20px;">
    			<div class="col l3"></div>
    			<div class="col l6 m12 s12">
    				<div id="error_message" class="card-panel teal lighten-2" style="margin-bottom: 300px;">
						<div id="error_message_content" class="card-content white-text"></div>	
					</div>
							
					<div id="course" class="myCard">
						<div class="input-field col s12">
							<select id="year">
								<option value="1" selected>1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
							</select>
							<label>Year</label>
						</div>

						<div class="input-field col s12">
							<select id="fall">
							<option value="1">Fall</option>
							<option value="0">Spring</option>
							</select>
							<label>Fall or Spring</label>
						</div>
						<div class="center">
						<button class="btn waves-effect waves-light teal lighten-2" type="submit" name="action" id="submit">Submit<i class="material-icons right">send</i>
							</button>
						</div>
					
							<?php
								if($year>=1 && $year<=4 && $fall==1){
							?>
								<h5 class="center" ><?php echo "Year = $year"." and Sem = fall," ?> Semester Performance</h5>
							<?php
							}
							if($year>=1 && $year<=4 && $fall==0){
							?>
								<h5 class="center" ><?php echo "Year = ".$year." and Sem = spring," ?> Semester Performance</h5>
							<?php
							}
							?>
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

						<h5 id="sgpa">SGPA: </h5>
						<h5 id="cgpa"> CGPA: </h5>
	    			</div>
				</div>
			</div>

			<div id="footer-placeholder"></div>

			<script>
				$(document).ready(function(){
					$('select').formSelect();
					$("#navbar-placeholder").load("static/include/student_navbar.html");
					$("#footer-placeholder").load("static/include/student_footer.html");
					$('#error_message').hide();
					$("#submit").click(function(){
						var y = $('#year :selected').val();
						var f = $('#fall :selected').val();
						var url = 'student-any-semester-performance.php?year='+y+'&fall='+f;

						$(location).attr('href',url);
					});
					var year = "<?php  echo $year; ?>";
					var fall = "<?php  echo $fall; ?>";
					if(year>0 && year<5 && (fall==0 || fall==1)){
						$.ajax({
							type:"POST",
							url: "server/any_sem_grades.php",
							data:{
								year: year,
								fall: fall
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
									var element1 = document.getElementById('sgpa');
									var element2 = document.getElementById('cgpa');
									element1.innerHTML += result['sgpa'];
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
