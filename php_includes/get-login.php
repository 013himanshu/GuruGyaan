<?php 
	session_start();
	
	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);		
		return $data;
	}

	if($_SERVER["REQUEST_METHOD"]=="POST"){
		if(isset($_POST["stu_btn"]) && $_POST['stu_btn']=="stu_log"){			
			$mbl=test_input($_POST['mbl']);			
			$psw=test_input($_POST['psw']);
						
			if(empty($mbl)){
				echo 'Mobile No. Required';
			}
			else if(!preg_match("/^[0-9]{10}+$/",$mbl)){
				echo 'Invalid Mobile No.';
			}			
			else if(empty($psw)){
				echo 'Password Required';
			}
			else if(!preg_match("/^[a-zA-Z0-9\W_ ]{4,}+$/",$psw)){
				echo 'Invalid Password';
			}
			else{
				include('../conx.php');
				if($stmt = $conn->prepare("SELECT mbl, psw FROM student WHERE mbl=?")){
					if($stmt->bind_param("s", $mbl)){
						$stmt->execute();
						$stmt->bind_result($db_mbl, $db_psw);
						if($stmt->fetch()){
							if($psw==$db_psw){
								$_SESSION['stu']=$mbl;
								echo 'success';
							}
							else{
								echo 'Invalid Mobile No. Or Password';
							}							
							$stmt->close();
							$conn->close();
						}
						else{
							echo 'Invalid Mobile No. Or Password';
							$stmt->close();
							$conn->close();
						}
					}
				}
				
			}
			
			
		}
		if(isset($_POST["exp_btn"]) && $_POST['exp_btn']=="exp_log"){			
			$mbl=test_input($_POST['mbl']);			
			$psw=test_input($_POST['psw']);
						
			if(empty($mbl)){
				echo 'Mobile No. Required';
			}
			else if(!preg_match("/^[0-9]{10}+$/",$mbl)){
				echo 'Invalid Mobile No.';
			}			
			else if(empty($psw)){
				echo 'ePassword Required';
			}
			else if(!preg_match("/^[a-zA-Z0-9\W_ ]{4,}+$/",$psw)){
				echo 'Invalid Password';
			}
			else{
				include('../conx.php');
				if($stmt = $conn->prepare("SELECT mbl, psw FROM expert WHERE mbl=?")){
					if($stmt->bind_param("s", $mbl)){
						$stmt->execute();
						$stmt->bind_result($db_mbl, $db_psw);
						if($stmt->fetch()){
							if($psw==$db_psw){
								$_SESSION['exp']=$mbl;
								echo 'success';
							}
							else{
								echo 'Invalid Mobile No. Or Password';
							}							
							$stmt->close();
							$conn->close();
						}
						else{
							echo 'Invalid Mobile No. Or Password';
							$stmt->close();
							$conn->close();
						}
					}
				}				
			}
			
			
		}
	}
?>