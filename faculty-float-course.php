<?php
session_start();
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
		if($_SESSION['type'] == 'faculty'){
		?>
			<div id="navbar-placeholder" class="navbar-fixed"></div>

			<div class="row" style="margin-top: 30px;margin-bottom: 20px;">
    			<div class="col l3"></div>
    			<div class="col l6 m12 s12">
    				<h4 class="center">Float a course</h4>
					<div id="error_message" class="myCard">
						<div id="error_message_content"></div>
					</div>
					<div id="course_form">
						<div class="input-field col s12 center">
						    <select id="course_to_float">
						      <option value="0" disabled selected>Choose Course</option>
						    </select>
						    <select id="faculty_to_float" multiple>
						      <option value="0" disabled selected>Choose Faculties</option>
						    </select>
						    <select id="batch_to_float" multiple>
						      <option value="0" disabled selected>Choose Batches</option>
						    </select>
						    <select id="course_pre" multiple>
						      <option value="0" disabled selected>Choose Pre-requisites</option>
						    </select>
						    <input placeholder="Time Slot" id="time_slot" type="text" class="validate" maxlength="2">
						    <input placeholder="Minimum CGPA required" id="cgpa" type="number" class="validate" max="10" min="0">
						    <div id="pre-cg"></div>
						    <button class="btn waves-effect waves-light light-blue darken-4" type="submit" name="action" id="submit">Pre-req
							    <i class="material-icons right">send</i>
							</button>
							<button class="btn waves-effect waves-light light-blue darken-4" type="submit" name="action" id="submit1">Submit
							    <i class="material-icons right">send</i>
							</button>
						</div>
	    			</div>
				</div>
			</div>

			<div id="footer-placeholder"></div>

			<script>
				$(document).ready(function(){
					$("#navbar-placeholder").load("static/include/faculty_navbar.html");
					$("#footer-placeholder").load("static/include/faculty_footer.html");
					$('#error_message').hide();
					$('#submit1').hide();
					$.ajax({
						type:"POST",
						url: "server/all_course_catalogue_list.php",
						data:{
						},
						success: function(result){
							result = $.parseJSON(result);
							var element2 = document.getElementById('course_to_float');
							if(result['err']=='OK'){
								var n = result['course_id'].length;
								for(i=0;i<n;i++){
									element2.innerHTML += ('<option value="'+ result['course_id'][i] +'">' + result['course_name'][i] + '</option>'); 
								}
								$('select').formSelect();
							}
							else{
								$('#course_form').hide();
								$('#error_message').show();
								var element2 = document.getElementById('error_message_content');
								element2.innerHTML = result['err'];
							}
						}
					});
					$.ajax({
						type:"POST",
						url: "server/all_current_faculty_list.php",
						data:{
						},
						success: function(result){
							result = $.parseJSON(result);
							console.log(result);
							var element2 = document.getElementById('faculty_to_float');
							console.log(element2);
							if(result['err']=='OK'){
								var n = result['faculty_id'].length;
								for(i=0;i<n;i++){
									element2.innerHTML += ('<option value="'+ result['faculty_id'][i] +'">' + result['faculty_name'][i] + '</option>'); 
								}
								$('select').formSelect();
							}
							else{
								$('#course_form').hide();
								$('#error_message').show();
								var element2 = document.getElementById('error_message_content');
								element2.innerHTML = result['err'];
							}
						}
					});
					$.ajax({
						type:"POST",
						url: "server/all_current_batch_list.php",
						data:{
						},
						success: function(result){
							result = $.parseJSON(result);
							console.log(result);
							var element2 = document.getElementById('batch_to_float');
							console.log(element2);
							if(result['err']=='OK'){
								var n = result['batch_id'].length;
								for(i=0;i<n;i++){
									element2.innerHTML += ('<option value="'+ result['batch_id'][i] +'">' + result['batch_name'][i] + '</option>'); 
								}
								$('select').formSelect();
							}
							else{
								$('#course_form').hide();
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
							var element2 = document.getElementById('course_pre');
							if(result['err']=='OK'){
								var n = result['course_id'].length;
								for(i=0;i<n;i++){
									element2.innerHTML += ('<option value="'+ result['course_id'][i] +'">' + result['course_name'][i] + '</option>'); 
								}
								$('select').formSelect();
							}
							else{
								$('#course_form').hide();
								$('#error_message').show();
								var element2 = document.getElementById('error_message_content');
								element2.innerHTML = result['err'];
							}
						}
					});
					var pre_ids = [];
					var pre_names = [];
					$("#submit").click(function(){
						var x = document.getElementById('pre-cg');
						
						$('#course_pre :selected').each(function(i, sel){ 
						    pre_ids.push( $(sel).val());
						    pre_names.push( $(sel).text());
						});
						console.log('here');
						console.log(pre_ids);
						for(var i=0;i<pre_ids.length;i++){
							if(pre_ids[i]!=0){
								x.innerHTML += '<input placeholder="min cgpa in ' + pre_names[i] +'" id="' + pre_ids[i] + '" type="number" class="validate" max="10" min="0">';
							}
						}
						$('#submit1').show();
						$('#submit').hide();
					});
					// <input placeholder="Minimum CGPA required" id="cgpa" type="number" class="validate" max="10" min="4">
					$("#submit1").click(function(){
						var batch_ids = [];
						var batch_names = [];
						var faculty_ids = [];
						var faculty_names = [];
						$('#batch_to_float :selected').each(function(i, sel){ 
						    batch_ids.push( $(sel).val());
						    batch_names.push( $(sel).text());
						});
						$('#faculty_to_float :selected').each(function(i, sel){ 
						    faculty_ids.push( $(sel).val());
						    faculty_names.push( $(sel).text());
						});
						var pre_ids = [];
						var pre_names = [];
						$('#course_pre :selected').each(function(i, sel){ 
						    pre_ids.push( $(sel).val());
						    pre_names.push( $(sel).text());
						});
						var course_id = $('#course_to_float :selected').val();
						var course_name = $('#course_to_float :selected').text();
						var cgpa = $('#cgpa').val();
						var time_slot = $('#time_slot').val();
						var pre_cg = [];
						var pn = pre_ids.length;
						for(var i=0;i<pn;i++){
							pre_cg.push($('#'+pre_ids[i]).val());
						}
						if(course_id==0 || batch_ids.length==0){
							alert("Enter All details");
						}
						else{
							$.ajax({
								type:"POST",
								url: "server/float_faculty_course.php",
								data:{
									course_id: course_id,
									batch_ids: batch_ids,
									faculty_ids: faculty_ids,
									pre_ids: pre_ids,
									cgpa: cgpa,
									time_slot: time_slot,
									pre_cg: pre_cg
								},
								success: function(result){
									result = $.parseJSON(result);
									$('#error_message').show();
									var element2 = document.getElementById('error_message_content');
									if(result['err']=='OK'){
										element2.innerHTML = $('#course_to_float :selected').text() + ' floated succesfully <br> Batches: ' + batch_names + ' <br> Pre-requisites: ' + pre_names;
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
