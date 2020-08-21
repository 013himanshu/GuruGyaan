<?php 
	session_start();
	
	require('php_includes/functions.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Read | Guru Gyaan - Get Help Directly From Experts</title>
	<meta name="Description" content="Read all questions about everything asked by students.">
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
		<div class="col s12 blue-text text-lighten-1 center-align" style="margin-top:20px;padding:0px;">
			<h4 style="font-weight:300;letter-spacing:1px;">Read</h4>
		</div>		
	</div>
</div>

<div class="container content">
	<div class="row">
		<?php
			include('conx.php');
			if($stmt = $conn->prepare("SELECT ques.q_id, ques.ques, category.value FROM ques, category WHERE ques.category=category.c_id ORDER BY ques.add_date DESC, ques.add_time DESC")){
				$stmt->execute();
				$stmt->bind_result($q_id, $ques, $category);
				while($stmt->fetch()){
					$likes=get_likes($q_id);
					$dislikes=get_dislikes($q_id);
					echo '<div class="col s12 m12 l12">
						<div class="card white">
							<div class="card-content">
								<h5 class="blue-text text-lighten-1 head" style="padding:0px;">'.$ques.'</h5>
								<p class="blue-grey-text text-darken-1"><i class="fa fa-tag" aria-hidden="true"></i> '.$category.' | ';count_answers($q_id); echo '</p>';
								single_ans($q_id);
							echo '</div>
							<div class="card-action" style="padding:10px;">						
								<a href="reply.php?id='.$q_id.'" class="blue-grey-text text-darken-1">read more...</a>
								<h6 class="blue-grey-text text-darken-1 right h6'.$q_id.'" style="margin-top:1px;display:inline;letter-spacing:2px;font-size:20px;">'; like_or_dislike($q_id, $likes, $dislikes); echo'</h6>
							</div>
						</div>
					</div>';
				}
				$stmt->close();
				$conn->close();
			}
		?>
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
		$('.li-read').addClass('active');
	});	
</script>  
</body>
</html>