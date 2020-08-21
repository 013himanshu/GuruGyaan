<?php 
	session_start();
	
	require('php_includes/functions.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Guru Gyaan - Get Help Directly From Experts</title>
	<meta name="Description" content="Guru Gyaan is an online portal which fills the gap between the students &amp; professors by creating a network of both. The questions are asked by the students and are advised directly from the experts.">
	<meta name="robots" content="index, follow">
	<meta name="googlebot" content="index, follow">	
	<?php 
		require 'php_includes/import-framework.php';
	?>
	<link rel="stylesheet" type="text/css" href="css/navbar.css">
	<style>		
		.preloader-background {
			display: flex;
			align-items: center;
			justify-content: center;
			color:#fff;			
			position: fixed;
			z-index: 100;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;	
		}
		.spinner-layer{
			border-color:#42a5f5;
		}
		.content{display:none;}
		.head{padding:10px;letter-spacing:2px;font-weight:300;}
		
		.danger{background-color:#ff4444;}
		.success{background-color:#00C851;}
	</style>
	<script>	
		$( window ).load(function(){
			$('#preloader').fadeOut('fast', function(){
				$(this).remove();
				$('.content').fadeIn(1000);
			});
		});	
	</script>
</head>
<body>
<div class="preloader-background" id="preloader">
	<div class="preloader-wrapper active">
		<div class="spinner-layer">
			<div class="circle-clipper left">
				<div class="circle"></div>
			</div>
			<div class="gap-patch">
				<div class="circle"></div>
			</div>
			<div class="circle-clipper right">
				<div class="circle"></div>
			</div>
		</div>
	</div>
</div>

<!--nav bar starts-->	
<?php 
	require 'php_includes/navbar.php';
?>
<!--nav bar ends-->	


<div class="container content">
	<div class="row">
		<?php
			function test_input($data){
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);		
				return $data;
			}
			
			$q_id=test_input($_GET['id']);
			
			include('conx.php');
			if($stmt = $conn->prepare("SELECT ques.q_id, student.fname, student.lname, ques.ques, category.value FROM ques, student, category WHERE ques.ask_by=student.mbl AND ques.category=category.c_id AND ques.q_id=? ORDER BY ques.add_date DESC, ques.add_time DESC LIMIT 1")){
				if($stmt->bind_param("i", $q_id)){
					$stmt->execute();
					$stmt->bind_result($q_id, $fname, $lname, $ques, $category);
					$stmt->fetch();
					$likes=get_likes($q_id);
					$dislikes=get_dislikes($q_id);
					
						echo '<div class="col s12 m12 l12" id="question-col">
							<div class="card white">
								<div class="card-content">
									<h5 class="blue-text text-lighten-1 head" style="padding:0px;">'.$ques.'</h5>									
									<p class="blue-grey-text text-darken-1"><i class="fa fa-tag" aria-hidden="true"></i> '.$category.' | ';count_answers($q_id); echo '<br /><i class="fa fa-user-circle-o" aria-hidden="true"></i> '.$fname.' '.$lname.'</p>
								</div>
								<div class="card-action" style="padding:10px;">	
									<h6 class="blue-grey-text text-darken-1 h6'.$q_id.'" style="display:inline;letter-spacing:2px;font-size:20px;">'; like_or_dislike($q_id, $likes, $dislikes); echo'</h6>
								</div>
							</div>
						</div>';
						
					$stmt->close();
					$conn->close();
				}
			}
			
			if(isset($_SESSION['exp'])){
				include('conx.php');
				if($stmt = $conn->prepare("SELECT a_id FROM answers WHERE q_id=? AND answer_by=?")){
					if($stmt->bind_param("is", $q_id, $_SESSION['exp'])){
						$stmt->execute();
						if(!$stmt->fetch()){
							echo '<div class="col s12 m12 l12" id="answer-col">
								<div class="card white">
									<div class="card-content">
										<div class="row">
											<form class="col s12 m12 l12" id="answer_form" name="answer_form" autocomplete="off">
												<div class="input-field col s12 m12 l12" id="answer_err"></div>
												<div class="input-field col s12">
												  <textarea id="answer-box" class="materialize-textarea"></textarea>
												  <label for="answer-box">The Answer Box</label>
												</div>
												<div class="input-field col s12 center-align" id="answer_btn_div">
													<button type="submit" class="btn waves-effect waves-light blue lighten-1" id="answer_btn" name="answer_btn" style="letter-spacing:1px;">Submit</button>
												</div>
											</form>	
										</div>
									</div>									
								</div>
							</div>';
						}
						else{
							echo '<div class="col s12 m12 l12">
									<h6 class="blue-grey-text text-darken-1" style="display:inline;letter-spacing:2px;">You have answered this question.</h6>
								</div>';
						}
					}
				}
			}
			
			include('conx.php');
			if($stmt = $conn->prepare("SELECT expert.fname, expert.lname, answers.a_id, answers.answer, answers.add_date, answers.add_time FROM expert, answers WHERE expert.mbl=answers.answer_by AND q_id=? ORDER BY answers.add_date DESC, answers.add_time DESC")){
				if($stmt->bind_param("i", $q_id)){
					$stmt->execute();
					$stmt->bind_result($fname, $lname, $a_id, $answer, $date, $time);
					$x=0;
					while($stmt->fetch()){
						if($x==0){
							echo '<div class="col s12 m12 l12 center-align">
								<h6 class="blue-text text-lighten-1 head" style="font-size:18px;text-transform:uppercase;padding-top:30px;">Replies</h6>
							</div>';
							$x++;
						}
						echo '<div class="col s12 m12 l12">
							<div class="card white">
								<div class="card-content" style="padding:10px;">
									<h6 style="padding-bottom:5px;">'.nl2br($answer).'</h6>
									<p class="blue-grey-text text-darken-1" style="font-size:13px;"><i class="fa fa-user-circle-o" aria-hidden="true"></i> '.$fname.' '.$lname.'<br /><i class="fa fa-calendar" aria-hidden="true"></i> '.$date.'<br /><i class="fa fa-clock-o" aria-hidden="true"></i> '.$time.'</p>
								</div>
								<div class="card-action" style="padding:10px;">';
									$a_likes=get_a_likes($a_id);
									$a_dislikes=get_a_dislikes($a_id);
									echo '<p class="blue-grey-text text-darken-1 p'.$a_id.'" style="display:inline;letter-spacing:2px;style="font-size:13px;"">';ans_like_or_dislike($a_id, $a_likes, $a_dislikes); echo'</p>
								</div>
							</div>
						</div>';
					}
				}
			}
			
			
			
		?>
	</div>
</div>


<script>
	$(document).on("submit", "#answer_form", function(event){
		event.preventDefault();
		$('#answer_btn').addClass('disabled');		
		var ans=document.forms["answer_form"]["answer-box"].value;	
		var formData={ answer_btn:"answer_btn", ans_id:<?php echo $_GET['id']; ?>, ans:ans };		
		
		$.ajax({
			method: "POST",
			url: "php_includes/get-answer.php",
			data: formData
		}).done(function(msg){
			if(msg!="success"){
				var width=$(window).width();				
				if(width<=600){					
					Materialize.toast(msg, 3000);	
					$('.toast').addClass('danger');
				}
				else{
					$('#answer_err').hide().html('<p class="danger err" style="padding:5px;color:#fff;letter-spacing:1px;"><i class="fa fa-times-circle" aria-hidden="true"></i> '+msg+'</p>').fadeIn(3000);
					setTimeout(function(){  
						$('.err').slideUp(1000, function(){
							$('.err').remove();
						});
					}, 4000);
				}
				$('#answer_btn').removeClass('disabled');
			}
			else{
				var width=$(window).width();
				if(width<=600){
					Materialize.toast("Answer Submitted", 3000);
					$('.toast').addClass('success');
					$('#answer-col').slideUp(1000, function(){
						$('#answer-col').remove();
						$('#question-col').after('<div class="col s12 m12 l12"><h6 class="blue-grey-text text-darken-1" style="display:inline;letter-spacing:2px;">Answer Submitted.</h6></div>');
					});
				}
				else{
					$('#answer-col').slideUp(1000, function(){
						$('#answer-col').remove();
						$('#question-col').after('<div class="col s12 m12 l12"><h6 class="blue-grey-text text-darken-1" style="display:inline;letter-spacing:2px;">Answer Submitted.</h6></div>');
					});
				}
			}
			
		});	
		
	});
</script>
<script>
	$(document).on("click", ".qe-like-w", function(event){
		event.preventDefault();
		var q_id=$(this).attr("q_id");
		var formData={ opt:"qe-like-w", q_id:q_id };
		
		$.ajax({
			method: "POST",
			url: "php_includes/get-q-likes.php",
			data: formData
		}).done(function(msg){
			$('.h6'+q_id).load("php_includes/get-h6.php", {q_id:q_id});
		});
		
	});
</script>
<script>
	$(document).on("click", ".qe-like-b", function(event){
		event.preventDefault();
		var q_id=$(this).attr("q_id");
		var formData={ opt:"qe-like-b", q_id:q_id };
		
		$.ajax({
			method: "POST",
			url: "php_includes/get-q-likes.php",
			data: formData
		}).done(function(msg){
			$('.h6'+q_id).load("php_includes/get-h6.php", {q_id:q_id});
		});
		
	});
</script>
<script>
	$(document).on("click", ".qe-dislike-w", function(event){
		event.preventDefault();
		var q_id=$(this).attr("q_id");
		var formData={ opt:"qe-dislike-w", q_id:q_id };
		
		$.ajax({
			method: "POST",
			url: "php_includes/get-q-likes.php",
			data: formData
		}).done(function(msg){
			$('.h6'+q_id).load("php_includes/get-h6.php", {q_id:q_id});
		});
		
	});
</script>
<script>
	$(document).on("click", ".qe-dislike-b", function(event){
		event.preventDefault();
		var q_id=$(this).attr("q_id");
		var formData={ opt:"qe-dislike-b", q_id:q_id };
		
		$.ajax({
			method: "POST",
			url: "php_includes/get-q-likes.php",
			data: formData
		}).done(function(msg){
			$('.h6'+q_id).load("php_includes/get-h6.php", {q_id:q_id});
		});
		
	});
</script>

<!--answers scripts-->
<script>
	$(document).on("click", ".as-like-w", function(event){
		event.preventDefault();
		var a_id=$(this).attr("a_id");
		var formData={ opt:"as-like-w", a_id:a_id };
		
		$.ajax({
			method: "POST",
			url: "php_includes/get-a-likes.php",
			data: formData
		}).done(function(msg){
			$('.p'+a_id).load("php_includes/get-p.php", {a_id:a_id});
		});
		
	});
</script>
<script>
	$(document).on("click", ".as-like-b", function(event){
		event.preventDefault();
		var a_id=$(this).attr("a_id");
		var formData={ opt:"as-like-b", a_id:a_id };
		
		$.ajax({
			method: "POST",
			url: "php_includes/get-a-likes.php",
			data: formData
		}).done(function(msg){
			$('.p'+a_id).load("php_includes/get-p.php", {a_id:a_id});
		});
		
	});
</script>
<script>
	$(document).on("click", ".as-dislike-w", function(event){
		event.preventDefault();
		var a_id=$(this).attr("a_id");
		var formData={ opt:"as-dislike-w", a_id:a_id };
		
		$.ajax({
			method: "POST",
			url: "php_includes/get-a-likes.php",
			data: formData
		}).done(function(msg){
			$('.p'+a_id).load("php_includes/get-p.php", {a_id:a_id});
		});
		
	});
</script>
<script>
	$(document).on("click", ".as-dislike-b", function(event){
		event.preventDefault();
		var a_id=$(this).attr("a_id");
		var formData={ opt:"as-dislike-b", a_id:a_id };
		
		$.ajax({
			method: "POST",
			url: "php_includes/get-a-likes.php",
			data: formData
		}).done(function(msg){
			$('.p'+a_id).load("php_includes/get-p.php", {a_id:a_id});
		});
		
	});
</script>
</body>
</html>