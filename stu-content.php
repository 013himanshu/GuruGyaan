<?php 
	session_start();
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
	<div class="col s12 m12 l12 center-align">
		<h6 class="blue-text text-lighten-1 head" style="font-size:18px;text-transform:uppercase;padding-top:30px;">My Content</h6>
	</div>
<?php
			include('conx.php');
			if($stmt = $conn->prepare("SELECT ques.q_id, ques.ques, category.value FROM ques, category WHERE ques.category=category.c_id AND ques.ask_by=? ORDER BY ques.add_date DESC, ques.add_time DESC")){
				if($stmt->bind_param("s", $_SESSION['stu'])){
					$stmt->execute();
					$stmt->bind_result($q_id, $ques, $category);
					$flag=0;
					while($stmt->fetch()){
						$flag=1;
						echo '<div class="col s12 m12 l12">
							<div class="card white">
								<div class="card-content">
									<h5 class="blue-text text-lighten-1 head" style="padding:0px;">'.$ques.'</h5>
									<p class="blue-grey-text text-darken-1"><i class="fa fa-tag" aria-hidden="true"></i> '.$category.'</p>									
								</div>
								<div class="card-action" style="padding:10px;">						
									<a href="stu-edit.php?q_id='.$q_id.'" class="blue-grey-text text-darken-1">edit...</a>									
								</div>
							</div>
						</div>';
					}
				}
				if($flag==0){
					echo '<div class="col s12 m12 l12 center-align" style="margin-top:20px;">
						<h5 class="blue-grey-text text-darken-1">You have not answered any questions.</h5>
					</div>';
				}
				$stmt->close();
				$conn->close();
			}
?>
	</div>
</div>


<script>	
	$( window ).load(function(){
		$('.li-content').addClass('active');
	});	
</script>
</body>
</html>