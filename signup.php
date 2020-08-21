<?php 
	session_start();
	if(isset($_SESSION['stu']) || isset($_SESSION['exp'])){
		header("Location:index.php");
		exit(0);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SignUp | Guru Gyaan</title>
	<meta name="Description" content="SignUp as student or expert to start asking or answering questions on Guru Gyaan.">
	<meta name="robots" content="index, follow">
	<meta name="googlebot" content="index, follow">	
	<!--viewport and materialize files-->
	<?php
		require 'php_includes/import-framework.php';
	?>		
	
	<style>
		body{background-color:#64b5f6 !important;}
				
		.block{
			padding-left:20%;
			padding-right:20%;
		}
		@media only screen and (max-width: 767px){
			.block{
				padding-left:0px;
				padding-right:0px;
			}
		}
		.tabs .indicator {			
			background-color: #42a5f5;			
		}
		
		.card-panel {
			padding-top:0px;
		}	
		
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
			border-color:#fff;
		}
		
		.danger{background-color:#ff4444;}
		.success{background-color:#00C851;}
	</style>
	<script>	
		$( window ).load(function(){
			$('#preloader').fadeOut('fast', function(){
				$(this).remove();				
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

<div class="container content">
	<div class="row">	
		<div class="col s12 white-text center-align" style="margin-top:10px;padding:0px;">
			<h4 style="font-weight:300;letter-spacing:1px;">Create Your Account</h4>
		</div>		
	</div>
</div>

<div class="container content">
	<div class="row">
		<div class="col s12">
			<div class="block">
				<div class="card-panel z-depth-2" style="padding:5px;padding-bottom:0px;">
					
					<ul class="tabs">
						<li class="tab col s6"><a class="active blue-text text-lighten-1" href="#student">Student</a></li>
						<li class="tab col s6"><a class="blue-text text-lighten-1" href="#expert">Expert</a></li>					
					</ul>
					<div id="student">
						<div class="row">
							<form class="col s12" id="stu_form" name="stu_form" autocomplete="off" style="padding-top:10px;">
								<div class="col s12 m12 l12" id="stu_err"></div>
								<div class="input-field col s6 m6 l6">									
									<input type="text" id="stu_fname" name="stu_fname" class="validate" required />									
									<label for="stu_fname" data-error="Invalid">First Name</label>
								</div>
								<div class="input-field col s6 m6 l6">									
									<input type="text" id="stu_lname" name="stu_lname" class="validate" required />									
									<label for="stu_lname" data-error="Invalid">Last Name</label>
								</div>
								<div class="input-field col s12 m6 l6">									
									<input type="tel" minlength="10" maxlength="10" id="stu_mbl" name="stu_mbl" class="validate" required />									
									<label for="stu_mbl" data-error="Invalid">Mobile No.</label>
								</div>
								<div class="input-field col s12 m6 l6">									
									<input type="email" id="stu_email" name="stu_email" class="validate" required />									
									<label for="stu_email" data-error="Invalid">Email</label>
								</div>
								<div class="input-field col s12 m12 l12">									
									<input type="password" minlength="4" id="stu_psw" name="stu_psw" class="validate" required />									
									<label for="stu_psw" data-error="Invalid">Password</label>
								</div>
								<div class="input-field col s12 center-align" id="stu_btn_div">
									<button type="submit" class="btn-large waves-effect waves-light blue lighten-1" id="stu_btn" name="stu_btn" style="width:100%;letter-spacing:1px;">Submit</button>
								</div>	
							</form>
						</div>	
					</div>										
					
					<div id="expert">
						<div class="row">
							<form class="col s12" id="exp_form" name="exp_form" autocomplete="off" style="padding-top:10px;">
								<div class="col s12 m12 l12" id="exp_err"></div>
								<div class="input-field col s6 m6 l6">									
									<input type="text" id="exp_fname" name="exp_fname" class="validate" required />									
									<label for="exp_fname" data-error="Invalid">First Name</label>
								</div>
								<div class="input-field col s6 m6 l6">									
									<input type="text" id="exp_lname" name="exp_lname" class="validate" required />									
									<label for="exp_lname" data-error="Invalid">Last Name</label>
								</div>
								<div class="input-field col s12 m6 l6">									
									<input type="tel" minlength="10" maxlength="10" id="exp_mbl" name="exp_mbl" class="validate" required />									
									<label for="exp_mbl" data-error="Invalid">Mobile No.</label>
								</div>
								<div class="input-field col s12 m6 l6">									
									<input type="email" id="exp_email" name="exp_email" class="validate" required />									
									<label for="exp_email" data-error="Invalid">Email</label>
								</div>
								<div class="input-field col s12 m12 l12">									
									<input type="password" minlength="4" id="exp_psw" name="exp_psw" class="validate" required />									
									<label for="exp_psw" data-error="Invalid">Password</label>
								</div>
								<div class="input-field col s12 center-align" id="exp_btn_div">
									<button type="submit" class="btn-large waves-effect waves-light blue lighten-1" id="exp_btn" name="exp_btn" style="width:100%;letter-spacing:1px;">Submit</button>
								</div>	
							</form>
						</div>	
					</div>
					
					<div class="row">
						<div class="col s12 m12 l12">
							<h6 style="padding:5px;">Account already exists? <a href="login.php">Login Here...</a></h6>
						</div>
					</div>
					
				</div>
			</div>	
		</div>
	</div>
</div>

<!--script for student signup-->
<script>
	$(document).on("submit", "#stu_form", function(event){
		event.preventDefault();
		$('#stu_btn_div').load("php_includes/loader-btn.php");
		var fname=document.forms["stu_form"]["stu_fname"].value;
		var lname=document.forms["stu_form"]["stu_lname"].value;
		var mbl=document.forms["stu_form"]["stu_mbl"].value;
		var email=document.forms["stu_form"]["stu_email"].value;
		var psw=document.forms["stu_form"]["stu_psw"].value;		
		var formData={ stu_btn:"stu_sign", fname:fname, lname:lname, mbl:mbl, email:email, psw:psw };		
		
		$.ajax({
			method: "POST",
			url: "php_includes/get-signup.php",
			data: formData
		}).done(function(msg){				
			$("#loader-btn").remove();
			$("#stu_btn_div").html("<button type='submit' class='btn-large waves-effect waves-light blue lighten-1' id='stu_btn' name='stu_btn' style='width:100%;letter-spacing:1px;'>Submit</button>");					
			if(msg!="success"){								
				if(msg=="First Name Required" || msg=="Invalid First Name"){
					$('#stu_fname').addClass('invalid');
				}
				else if(msg=="Last Name Required" || msg=="Invalid Last Name"){
					$('#stu_lname').addClass('invalid');
				}
				else if(msg=="Mobile No. Required" || msg=="Invalid Mobile No."){
					$('#stu_mbl').addClass('invalid');
				}
				else if(msg=="Email Required" || msg=="Invalid Email"){
					$('#stu_email').addClass('invalid');
				}
				else if(msg=="Password Required" || msg=="Invalid Password"){
					$('#stu_psw').addClass('invalid');
				}
				var width=$(window).width();				
				if(width<=600){					
					Materialize.toast(msg, 3000);					
					$('.toast').addClass('danger');					
				}
				else{
					$('#stu_err').hide().html('<p class="danger err" style="padding:5px;color:#fff;letter-spacing:1px;"><i class="fa fa-times-circle" aria-hidden="true"></i> '+msg+'</p>').fadeIn(3000);
					setTimeout(function(){  
						$('.err').fadeOut(1000, function(){
							$('.err').remove();
						});
					}, 4000);
				}								
			}
			else{
				var width=$(window).width();
				if(width<=600){
					 Materialize.toast("SignUp Successful", 3000);
					 $('.toast').addClass('success');
				}				
				window.open("index.php", "_self");
			}							
		});	
		
	});
</script>

<!--script for expert signup-->
<script>
	$(document).on("submit", "#exp_form", function(event){
		event.preventDefault();
		$('#exp_btn_div').load("php_includes/loader-btn.php");
		var fname=document.forms["exp_form"]["exp_fname"].value;
		var lname=document.forms["exp_form"]["exp_lname"].value;
		var mbl=document.forms["exp_form"]["exp_mbl"].value;
		var email=document.forms["exp_form"]["exp_email"].value;
		var psw=document.forms["exp_form"]["exp_psw"].value;
		var formData={ exp_btn:"exp_sign", fname:fname, lname:lname, mbl:mbl, email:email, psw:psw };
		
		$.ajax({
			method: "POST",
			url: "php_includes/get-signup.php",
			data: formData
		}).done(function(msg){							
			$("#loader-btn").remove();
			$("#exp_btn_div").html("<button type='submit' class='btn-large waves-effect waves-light blue lighten-1' id='exp_btn' name='exp_btn' style='width:100%;letter-spacing:1px;'>Submit</button>");								
			if(msg!="success"){					
				if(msg=="First Name Required" || msg=="Invalid First Name"){
					$('#exp_fname').addClass('invalid');
				}
				if(msg=="Last Name Required" || msg=="Invalid Last Name"){
					$('#exp_lname').addClass('invalid');
				}
				if(msg=="Mobile No. Required" || msg=="Invalid Mobile No."){
					$('#exp_mbl').addClass('invalid');
				}
				if(msg=="Email Required" || msg=="Invalid Email"){
					$('#exp_email').addClass('invalid');
				}
				if(msg=="Password Required" || msg=="Invalid Password"){
					$('#exp_psw').addClass('invalid');
				}
				var width=$(window).width();				
				if(width<=600){					
					Materialize.toast(msg, 3000);					
					$('.toast').addClass('danger');					
				}
				else{
					$('#exp_err').hide().html('<p class="danger err" style="padding:5px;color:#fff;letter-spacing:1px;"><i class="fa fa-times-circle" aria-hidden="true"></i> '+msg+'</p>').fadeIn(3000);
					setTimeout(function(){  
						$('.err').fadeOut(1000, function(){
							$('.err').remove();
						});
					}, 4000);
				}				
			}
			else{
				var width=$(window).width();
				if(width<=600){
					Materialize.toast("SignUp Successful", 3000);
					$('.toast').addClass('success');
				}				
				window.open("index.php", "_self");
			}							
		});	
		
	});
</script>

</body>
</html>