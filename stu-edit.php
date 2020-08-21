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
		include('conx.php');
			if($stmt = $conn->prepare("SELECT ques.q_id, ques.ques, category.value FROM ques, category WHERE ques.category=category.c_id AND ques.q_id=? AND ques.ask_by=? ORDER BY ques.add_date DESC, ques.add_time DESC")){
				if($stmt->bind_param("is", $_GET['q_id'], $_SESSION['stu'])){
					$stmt->execute();
					$stmt->bind_result($q_id, $ques, $category);					
					if($stmt->fetch()){						
						echo '<div class="col s12 m12 l12" id="question-col">
							<div class="card white">
								<div class="card-content">
									<h5 class="blue-text text-lighten-1 head" style="padding:0px;">'.$ques.'</h5>
									<p class="blue-grey-text text-darken-1"><i class="fa fa-tag" aria-hidden="true"></i> '.$category.'</p>
								</div>
							</div>
						</div>
						<div class="col s12 m12 l12" id="answer-col">
								<div class="card white">
									<div class="card-content">
										<div class="row">
											<form class="col s12 m12 l12" id="answer_form" name="answer_form" autocomplete="off">
												<div class="input-field col s12 m12 l12" id="answer_err"></div>
												<div class="input-field col s12">
												  <textarea id="answer-box" class="materialize-textarea">'.$ques.'</textarea>
												  <label for="answer-box">The Edit Box</label>
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
				}
				$stmt->close();
				$conn->close();
			}
	?>
	</div>
</div>

<script>
	$(document).on("submit", "#answer_form", function(event){
		event.preventDefault();
		$('#answer_btn').addClass('disabled');		
		var ans=document.forms["answer_form"]["answer-box"].value;	
		var formData={ answer_btn:"answer_btn", q_id:<?php echo $_GET['q_id']; ?>, ans:ans };		
		
		$.ajax({
			method: "POST",
			url: "php_includes/update-answer.php",
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
					Materialize.toast("Question Updated", 3000);
					$('.toast').addClass('success');
					$('#answer-col').slideUp(1000, function(){
						$('#answer-col').remove();
						$('#question-col').after('<div class="col s12 m12 l12"><h6 class="blue-grey-text text-darken-1" style="display:inline;letter-spacing:2px;">Question Updated.</h6></div>');
					});
				}
				else{
					$('#answer-col').slideUp(1000, function(){
						$('#answer-col').remove();
						$('#question-col').after('<div class="col s12 m12 l12"><h6 class="blue-grey-text text-darken-1" style="display:inline;letter-spacing:2px;">Question Updated.</h6></div>');
					});
				}
			}
			
		});	
		
	});
</script>
</body>
</html>