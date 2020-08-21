<?php 
	session_start();
	if(!isset($_SESSION['stu'])){
		header("Location:index.php");
		exit(0);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ask | Guru Gyaan - Get Help Directly From Experts</title>
	<meta name="Description" content="Ask a question about anything to your gurus. The questions are asked by the students and are advised directly from the experts.">
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

		.dropdown-content li>span{
			color:#42a5f5 !important;
		}
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
	<script>
		$(document).ready(function() {
			$('select').material_select();
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
		<div class="col s12 blue-text text-lighten-1 center-align" style="margin-top:20px;padding:0px;">
			<h4 style="font-weight:300;letter-spacing:1px;">ASK</h4>
		</div>		
	</div>
</div>

<div class="container content">
	<div class="row">
		<div class="col s12 m12 l12">
			<div class="card ask-card" style="padding:5px;padding-bottom:2px;">
				<div class="row">						
					<form class="col s12" id="ask_form" name="ask_form" autocomplete="off">						
						<div class="input-field col s12 m12 l12" id="ask_err"></div>
						<div class="input-field col s12 m6 l6">									
							<input type="text" id="ques" name="ques" class="validate" required />									
							<label for="ques" data-error="Invalid">Ask Guru Gyaan</label>
						</div>
						<div class="input-field col s12 m6 l6">
							<select id="category" name="category" required>
								<option value="" selected>Choose category</option>
								<?php 
									include ('conx.php');
									if($stmt=$conn->prepare("SELECT c_id, value FROM category ORDER BY value;")){
										$stmt->execute();
										$stmt->bind_result($c_id, $value);
										while($stmt->fetch()){
											echo '<option value="'.$c_id.'">'.$value.'</option>';
										}
										$stmt->close();
										$conn->close();										
									}
								?>							
							</select>
						</div>
						<div class="input-field col s12 m12 l12 center-align" id="ask_btn_div">
							<button type="submit" class="btn waves-effect waves-light blue lighten-1" id="ask_btn" name="ask_btn" style="letter-spacing:1px;">Submit</button>
						</div>										
					</form>
				</div>
			</div>
		</div>			
	</div>	
	<div class="row">
		<div class="col s12 m12 l12">
			<h6 class="blue-grey-text text-lighten-2 head" style="padding:0px;">Note :</h6>
			<ul class="browser-default" style="padding:5px;">
				<li class="blue-grey-text text-lighten-2">The question should not contain any inappropriate words.</li>
				<li class="blue-grey-text text-lighten-2">Valid category must be selected with each question.</li>
				<li class="blue-grey-text text-lighten-2">There is no guarantee that your question will be answered.</li>
				<li class="blue-grey-text text-lighten-2">No personal questions are allowed.</li>
			</ul>
		</div>
	</div>	
</div>


<div class="content blue lighten-2">
	<div class="row">
		<h6 class="white-text head">Hot Topics</h6>
		<!--random questions in card/panel-->		
		<div class="row">
			<?php 
				include('conx.php');
				if($stmt = $conn->prepare("SELECT ques.q_id, ques.ques, category.value FROM ques, category WHERE ques.category=category.c_id ORDER BY RAND() LIMIT 4")){
					$stmt->execute();
					$stmt->bind_result($q_id, $ques, $category);
					while($stmt->fetch()){
						echo '<div class="col s12 m3 l3">
							<div class="card white z-depth-2">
								<div class="card-content">
									<span class="card-title blue-text text-lighten-1"><i class="fa fa-tag" aria-hidden="true"></i> '.$category.'</span>
									<p>'.$ques.'</p>
								</div>
								<div class="card-action">						
									<a href="read-more.php?id='.$q_id.'" class="blue-grey-text text-darken-1">Read More...</a>
								</div>
							</div>
						</div>';
					}
				}
			?>			
		</div>		
	</div>
</div>


<?php 
	require 'php_includes/footer.php';
?>


<script>
	$(document).on("submit", "#ask_form", function(event){
		event.preventDefault();
		$('#ask_btn_div').html('<p class="blue-text text-lighten-1 center-align"><i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i></p>');		
		var ques=document.forms["ask_form"]["ques"].value;
		var cat=document.forms["ask_form"]["category"].value;		
		var formData={ ask_btn:"ask_btn", ques:ques, cat:cat };		
		
		$.ajax({
			method: "POST",
			url: "php_includes/get-ask.php",
			data: formData
		}).done(function(msg){
			if(msg!="success"){
				var width=$(window).width();				
				if(width<=600){					
					Materialize.toast(msg, 3000);	
					$('.toast').addClass('danger');
				}
				else{
					$('#ask_err').hide().html('<p class="danger err" style="padding:5px;color:#fff;letter-spacing:1px;"><i class="fa fa-times-circle" aria-hidden="true"></i> '+msg+'</p>').fadeIn(3000);
					setTimeout(function(){  
						$('.err').slideUp(1000, function(){
							$('.err').remove();
						});
					}, 4000);
				}
			}
			else{
				var width=$(window).width();
				if(width<=600){
					 Materialize.toast("Question Submitted", 3000);
					 $('.toast').addClass('success');
					 $('#ques').val('');
				}
				else{
					$('#ask_err').hide().html('<p class="success err" style="padding:5px;color:#fff;letter-spacing:1px;"><i class="fa fa-check-circle" aria-hidden="true"></i> Question Submitted</p>').fadeIn(2000);
					setTimeout(function(){  
						$('.err').slideUp(1000, function(){
							$('.err').remove();							
						});
					}, 4000);
				}
				document.getElementById('ask_form').reset();
				$('#ques').click().blur();
			}
			$('#ask_btn_div').html('<button type="submit" class="btn waves-effect waves-light blue lighten-1" id="ask_btn" name="ask_btn" style="letter-spacing:1px;">Submit</button>');																
		});	
		
	});
</script>
<script>	
	$( window ).load(function(){
		$('.li-ask').addClass('active');
	});	
</script>  
</body>
</html>