<?php 
session_start();


function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
}

if(isset($_SESSION['exp']) || isset($_SESSION['stu'])){
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
					include('../conx.php');
					if($stmt=$conn->prepare("UPDATE answers SET answer=? WHERE a_id=?")){
						if($stmt->bind_param("si", $ans, $ans_id)){
							$stmt->execute();
							$stmt->close();
							$conn->close();
							echo 'success';
						}
					}
				}
			}
			
			if(isset($_POST['q_id']) && isset($_POST['ans'])){
				$q_id=test_input($_POST['q_id']);
				$ans=test_input($_POST['ans']);
				
				if(empty($q_id)){
					echo 'Unknown id error.';
				}
				else if(!preg_match("/^[0-9]+$/",$q_id)){
					echo 'Unknown id error.';
				}
				else if(empty($ans)){
					echo 'Answer required.';
				}
				else if(!preg_match("/^[a-zA-Z0-9\.\+()_,\-\/\?%\n\W\w ]+$/",$ans)){
					echo 'Invalid answer.';
				}
				else{
					include('../conx.php');
					if($stmt=$conn->prepare("UPDATE ques SET ques=? WHERE q_id=?")){
						if($stmt->bind_param("si", $ans, $q_id)){
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


?>