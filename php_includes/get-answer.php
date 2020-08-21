<?php 
session_start();


function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
}

if(isset($_SESSION['exp'])){
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		if(isset($_POST['answer_btn']) && $_POST['answer_btn']=="answer_btn"){
			if(isset($_POST['ans_id']) && isset($_POST['ans'])){
				$ans_id=test_input($_POST['ans_id']);
				$ans=test_input($_POST['ans']);
				
				if(empty($ans_id)){
					echo 'Unknown id error.';
				}
				else if(!preg_match("/^[0-9]+$/",$ans_id)){
					echo 'Unknown id error.';
				}
				else if(empty($ans)){
					echo 'Answer required.';
				}
				else if(!preg_match("/^[a-zA-Z0-9\.\+()_,\-\/\?%\n\W\w ]+$/",$ans)){
					echo 'Invalid answer.';
				}
				else{
					date_default_timezone_set("Asia/Kolkata");
					$date=$time="";
					$date=date("Y-m-d");				
					$time=date("h:i:sa");
					
					include('../conx.php');
					if($stmt=$conn->prepare("INSERT INTO answers (q_id, answer_by, answer, add_date, add_time) VALUES (?,?,?,?,?)")){
						if($stmt->bind_param("issss", $ans_id, $_SESSION['exp'], $ans, $date, $time)){
							$stmt->execute();
							$stmt->close();
							$conn->close();
							echo 'success';
						}
					}
				}
			}
		}
		else{
			echo 'Invalid parameters.';
		}
	}
	else{
		echo 'Invalid request method.';
	}
}
else{
	echo 'No expert logged in.';
}

?>