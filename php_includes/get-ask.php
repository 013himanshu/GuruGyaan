<?php 
session_start();

function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
}

if(isset($_SESSION['stu'])){
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		if(isset($_POST['ask_btn']) && $_POST['ask_btn']=="ask_btn"){
			if(isset($_POST['ques']) && isset($_POST['cat'])){
				$ques=test_input($_POST['ques']);
				$cat=test_input($_POST['cat']);
				
				if(empty($ques)){					
					echo 'Question required.';
				}				
				else if(!preg_match("/^[a-zA-Z0-9\.\+()_,\-\/\?% ]+$/",$ques)){
					echo 'Invalid question.';
				}
				else if(empty($cat)){
					echo 'Category required.';
				}
				else if(!preg_match("/^[A-Za-z0-9 ]+$/",$cat)){
					echo 'Invlid Category';
				}
				else{
					date_default_timezone_set("Asia/Kolkata");
					$date=$time="";
					$date=date("Y-m-d");				
					$time=date("h:i:sa");
					
					include('../conx.php');
					if($stmt=$conn->prepare("INSERT INTO ques (ask_by, ques, category, add_date, add_time) VALUES (?,?,?,?,?)")){
						if($stmt->bind_param("sssss", $_SESSION['stu'], $ques, $cat, $date, $time)){
							$stmt->execute();
							$stmt->close();
							$conn->close();
							echo 'success';
						}
					}
				}
			}
			else{
				echo 'Invalid parameters';
			}
		}
		else{
			echo 'Invalid parameters';
		}
	}
	else{
		echo 'Invalid request method.';
	}
}
else{
	echo 'No student logged in.';
}

?>