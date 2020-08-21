<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password | Guru Gyaan</title>
	<meta name="robots" content="index, follow">
	<meta name="googlebot" content="index, follow">	
	<!--viewport and materialize files-->
	<?php
		require 'php_includes/import-framework.php';
	?>		
	
	<style>
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
			border-color:#42a5f5;
		}
		.content{display:none;}
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

<div class="container content">
	<div class="row">	
		<div class="col s12 blue-text text-lighten-1 center-align" style="margin-top:10px;padding:0px;">
			<h4 style="font-weight:300;letter-spacing:1px;">Change Password</h4>
		</div>		
	</div>
</div>

<div class="container content">
	<div class="row">
		<div class="col s12 m12 l12">
			<div class="card white">
				<div class="card-content">
					<div class="row">
						<form class="col s12 m12 l12" id="psw_form" name="psw_form" autocomplete="off">
							<div class="input-field col s12 m12 l12" id="psw_err"></div>
							<div class="input-field col s12 m12 l12">
								<input type="tel" minlength="10" maxlength="10" id="mbl" name="mbl" class="validate" required />									
								<label for="mbl" data-error="Invalid">Mobile No.</label>
							</div>
							<div class="input-field col s6 m6 l6">
								<input type="password" minlength="4" id="c_psw" name="c_psw" class="validate" required />									
								<label for="c_psw" data-error="Invalid">Current Password</label>
							</div>
							<div class="input-field col s6 m6 l6">
								<input type="password" minlength="4" id="psw" name="psw" class="validate" required />									
								<label for="psw" data-error="Invalid">New Password</label>
							</div>
							<div class="input-field col s12 center-align" id="psw_btn_div">
								<button type="submit" class="btn waves-effect waves-light blue lighten-1" id="psw_btn" name="psw_btn" style="letter-spacing:1px;">Submit</button>
							</div>
						</form>	
					</div>
				</div>									
			</div>	
		</div>
	</div>
</div>


<!--script for student login-->
<script>
	$(document).on("submit", "#psw_form", function(event){
		event.preventDefault();
		$('#psw_btn').addClass("disabled");		
		var mbl=document.forms["psw_form"]["mbl"].value;		
		var c_psw=document.forms["psw_form"]["c_psw"].value;
		var psw=document.forms["psw_form"]["psw"].value;				
		var formData={ psw_btn:"psw_btn", mbl:mbl, c_psw:c_psw, psw:psw };		
		
		$.ajax({
			method: "POST",
			url: "php_includes/update-exp-psw.php",
			data: formData
		}).done(function(msg){
			$('#psw_btn').removeClass("disabled");												
			if(msg!="success"){								
				if(msg=="Mobile No. Required" || msg=="Invalid Mobile No."){
					$('#mbl').addClass('invalid');
				}				
				if(msg=="Current Password Required" || msg=="Invalid Current Password"){
					$('#c_psw').addClass('invalid');
				}
				if(msg=="New Password Required" || msg=="Invalid New Password"){
					$('#psw').addClass('invalid');
				}
				var width=$(window).width();				
				if(width<=600){					
					Materialize.toast(msg, 3000);					
					$('.toast').addClass('danger');					
				}
				else{
					$('#psw_err').hide().html('<p class="danger err" style="padding:5px;color:#fff;letter-spacing:1px;"><i class="fa fa-times-circle" aria-hidden="true"></i> '+msg+'</p>').fadeIn(3000);
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
					 Materialize.toast("Password Updated Successfuly", 3000);
					 $('.toast').addClass('success');
				}
				else{
					$('#psw_err').hide().html('<p class="success err" style="padding:5px;color:#fff;letter-spacing:1px;"><i class="fa fa-check-circle" aria-hidden="true"></i> Password Updated Successfuly</p>').fadeIn(3000);
				}
			}							
		});	
		
	});
</script>
</body>
</html>