<?php
session_start();

$course_id = 0;

if(isset($_GET['id'])){
	$course_id = $_GET['id'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	<title>Float Course | IIT Ropar</title>
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
		if($_SESSION['type'] == 'staff' || $_SESSION['type'] == 'dean'){
		?>
			<div id="navbar-placeholder" class="navbar-fixed"></div>

			<div class="row" style="margin-top: 30px;margin-bottom: 20px;">
    			<div class="col l3"></div>
    			<div class="col l6 m12 s12">
    				<h4 class="center">Edit a course</h4>
					<div id="error_message" class="myCard">
						<div id="error_message_content"></div>
					</div>
					<div id="course_form">
						<div class="input-field col s12 center">
							<?php
							if($course_id<=0){

							?>
						    <select id="course_pre">
						      <option value="0" disabled selected>Choose Course</option>
						    </select>
						    <br>
							<button class="btn waves-effect waves-light light-blue darken-4" type="submit" name="action" id="submit">Submit
							    <i class="material-icons right">send</i>
							</button>
							<?php
							}
							else{
								?>

								<input placeholder="Course Name" id="n" type="text" class="validate">
								<select id="course_pre" multiple>
							      <option value="0" disabled selected>Choose Pre-requisites</option>
							    </select>
							    <input placeholder="Lectures" id="l" type="number" class="validate" max="9" min="0">
							    <input placeholder="Tutorials" id="t" type="number" class="validate" max="9" min="0">
							    <input placeholder="Practicals" id="p" type="number" class="validate" max="9" min="0">
							    <input placeholder="Course Content" id="c" type="text" class="validate">
							    <br>
								<button class="btn waves-effect waves-light light-blue darken-4" type="submit" name="action" id="submit1">Submit
								    <i class="material-icons right">send</i>
								</button>
								<?php
							}
							?>
						</div>
	    			</div>
				</div>
			</div>

			<div id="footer-placeholder"></div>

			<script>
				$(document).ready(function(){
					$('#error_message').hide();
					$.ajax({
						type:"POST",
						url: "server/all_course_catalogue_list.php",
						data:{
						},
						success: function(result){
							result = $.parseJSON(result);
							var element2 = document.getElementById('course_pre');
							if(result['err']=='OK'){
								var n = result['course_id'].length;
								for(i=0;i<n;i++){
									element2.innerHTML += ('<option value="'+ result['course_id'][i] +'">' + result['course_name'][i] + '</option>'); 
								}
								$('select').formSelect();
							}
							else{
								$('#error_message').show();
								var element2 = document.getElementById('error_message_content');
								element2.innerHTML = result['err'];
							}
						}
					});
					$("#submit").click(function(){
						var course_id = $('#course_pre :selected').val();
						
						if(course_id == 0){
							alert("Select a course");
						}
						else{
							location.href = "edit-course.php?id=" + course_id;
						}
					});
					var boo = '<?php echo $course_id; ?>';
					if(boo >0){

						$.ajax({
							type:"POST",
							url: "server/course_detail.php",
							data:{
								course_id : boo
							},
							success: function(result){
								result = $.parseJSON(result);
								var element2 = document.getElementById('course_pre1');
								if(result['err']=='OK'){
									$("#course_pre").val(result['pre_id']);
									document.getElementById('l').value = result['l'];
									document.getElementById('t').value = result['t'];
									document.getElementById('p').value = result['p'];
									document.getElementById('n').value = result['name'];
									document.getElementById('c').value = result['description'];
									$('select').formSelect();
								}
								else{
									$('#error_message').show();
									var element2 = document.getElementById('error_message_content');
									element2.innerHTML = result['err'];
								}
							}
						});
						$("#submit1").click(function(){
							var course_name = $('#n').val();
							var l = $('#l').val();
							var t = $('#t').val();
							var p = $('#p').val();
							var content = $('#c').val();
							var course_id = '<?php echo $course_id; ?>';
							var pre_id = [];
							$('#course_pre :selected').each(function(i, sel){ 
							    pre_id.push( $(sel).val());
							});

							if(course_name=="" || l=="" || t=="" || p=="" || content==""){
								alert("Enter All details");
							}
							else{
								$.ajax({
									type:"POST",
									url: "server/update_course.php",
									data:{
										name: course_name,
										l: l,
										t: t,
										p: p,
										content: content,
										pre_id : pre_id,
										course_id : course_id
									},
									success: function(result){
										result = $.parseJSON(result);
										console.log(result);
										$('#error_message').show();
										var element2 = document.getElementById('error_message_content');
										if(result['err']=='OK'){
											element2.innerHTML = 'Course Updated Successfully';
										}
										else{
											element2.innerHTML = result['err'];
										}
									}
								});
							}
							
						});
					}
				});
			</script>
		<?php
		if($_SESSION['type'] == 'staff'){
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
		}
	}
?>

</body>
</html>
