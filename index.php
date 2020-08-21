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
		.head{padding:10px;letter-spacing:2px;font-weight:300;}
		.head-tag{padding:10px;letter-spacing:2px;text-transform:uppercase;}
	
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
		
		.tabs .indicator {			
			background-color: #42a5f5;			
		}
		
		.card-panel {
			padding-top:0px;
		}
		
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
		 $(document).ready(function(){
		  $('.carousel').carousel();
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




<div class="row content" style="padding:0px !important;">
	<div class="col s12 m6 l6 header-img" style="padding:0px !important;"><img src="images/guru-class.png" style="height:320px !important;" /></div>
	
	<div class="col s12 m6 l6">
		<div class="card">
			<div class="card-content" style="padding:3px;">
				<h5 class="blue-text text-lighten-1 center" style="font-size:20px;">What's New?</h5>
			</div>
		</div>
			
					<?php
						include('conx.php');
						if($stmt = $conn->prepare("SELECT ques.q_id, ques.ques, category.value FROM ques, category WHERE ques.category=category.c_id ORDER BY ques.add_date DESC, ques.add_time DESC LIMIT 3")){
							$stmt->execute();
							$stmt->bind_result($q_id, $ques, $category);
							while($stmt->fetch()){
								$likes=get_likes($q_id);
								$dislikes=get_dislikes($q_id);
								echo '
									<div class="card white">
										<div class="card-content">
											<h6 class="blue-text text-lighten-1 head" style="padding:0px;">'.$ques.'</h6>
											<h6 class="blue-grey-text text-darken-1" style="font-size:13px;"><i class="fa fa-tag" aria-hidden="true"></i> '.$category.' | ';count_answers($q_id); echo '</h6>
										</div>
										<div class="card-action" style="padding:5px;">						
											<a href="reply.php?id='.$q_id.'" class="blue-grey-text text-darken-1" style="font-size:11px;">Read More...</a>
											<h6 class="right blue-grey-text text-darken-1 h6'.$q_id.'" style="display:inline;letter-spacing:2px;font-size:13px;">'; like_or_dislike($q_id, $likes, $dislikes); echo'</h6>
										</div>
									</div>
								';
							}
						}
					?>
				
		
		
			
		
	</div>
	
</div>


<div class="content blue lighten-2">
	<div class="row">
		<h6 class="white-text head" style="font-size:20px;"><i class="fa fa-tag" aria-hidden="true"></i> Tags</h6>
		<!--random questions in card/panel-->		
		<div class="row">
			<div class="col s12 m3 l3">
				<div class="card white z-depth-2">
					<div class="card-content center-align">
						<span class="card-title blue-text text-lighten-1 icon-tag"><i class="fa fa-cogs" aria-hidden="true"></i></span>
						<h6 class="blue-text text-lighten-1 head-tag" style="font-size:25px;">TECHNOLOGY</h6>
					</div>
				</div>
			</div>
			<div class="col s12 m3 l3">
				<div class="card white z-depth-2">
					<div class="card-content center-align">
						<span class="card-title blue-text text-lighten-1 icon-tag"><i class="fa fa-book" aria-hidden="true"></i></span>
						<h6 class="blue-text text-lighten-1 head-tag" style="font-size:25px;">LITERATURE</h6>
					</div>
				</div>
			</div>
			<div class="col s12 m3 l3">
				<div class="card white z-depth-2">
					<div class="card-content center-align">
						<span class="card-title blue-text text-lighten-1 icon-tag"><i class="fa fa-gavel" aria-hidden="true"></i></span>
						<h6 class="blue-text text-lighten-1 head-tag" style="font-size:25px;">LAW</h6>
					</div>
				</div>
			</div>
			<div class="col s12 m3 l3">
				<div class="card white z-depth-2">
					<div class="card-content center-align">
						<span class="card-title blue-text text-lighten-1 icon-tag"><i class="fa fa-camera-retro" aria-hidden="true"></i></span>
						<h6 class="blue-text text-lighten-1 head-tag" style="font-size:25px;">PHOTOGRAPHY</h6>
					</div>
				</div>
			</div>
		</div>		
	</div>
</div>


<div class="content container">
	<div class="row">	
		<div class="row">
			<div class="col s12 m4 l4">
				<div class="card white">
					<div class="card-content center-align">
						<span class="card-title blue-text text-lighten-1" style="font-size:22px;"><i class="fa fa-quote-left" aria-hidden="true"></i> The question isn't 'What do we want to know about people?' It's, 'What do people want to tell about themselves?' <i class="fa fa-quote-right" aria-hidden="true"></i></span>
						<h6 class="blue-text text-lighten-1">-Mark Zuckerberg</h6>
					</div>
				</div>
			</div>
			<div class="col s12 m4 l4">
				<div class="card white">
					<div class="card-content center-align">
						<span class="card-title blue-text text-lighten-1" style="font-size:22px;"><i class="fa fa-quote-left" aria-hidden="true"></i> Progress is building something lasting for future. <i class="fa fa-quote-right" aria-hidden="true"></i></span>
						<h6 class="blue-text text-lighten-1">-Chetan Bhagat</h6>
					</div>
				</div>
			</div>
			<div class="col s12 m4 l4">
				<div class="card white">
					<div class="card-content center-align">
						<span class="card-title blue-text text-lighten-1" style="font-size:22px;"><i class="fa fa-quote-left" aria-hidden="true"></i> Fashion is not necessarily about labels. It’s not about brands. It’s about something else that comes from within you. <i class="fa fa-quote-right" aria-hidden="true"></i></span>
						<h6 class="blue-text text-lighten-1">-Ralph Lauren</h6>
					</div>
				</div>
			</div>
		</div>		
	</div>
</div>


<?php 
	require 'php_includes/footer.php';
?>

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
<script>	
	$( window ).load(function(){
		$('.li-home').addClass('active');
		$('.header-img').html('<img src="images/guru-class-sm.png" width="100%" />');
	});	
</script>  
</body>
</html>