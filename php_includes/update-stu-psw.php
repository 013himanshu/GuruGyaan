<?php 
	session_start();
	
	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);		
		return $data;
	}
	
	function update_psw($psw){
		include('../conx.php');
		if($stmt = $conn->prepare("UPDATE student SET psw=? WHERE mbl=?")){
			if($stmt->bind_param("ss", $psw, $_SESSION['stu'])){
				$stmt->execute();
			}
		}
	}
	
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		if(isset($_POST["psw_btn"]) && $_POST['psw_btn']=="psw_btn"){			
			$mbl=test_input($_POST['mbl']);
			$c_psw=test_input($_POST['c_psw']);
			$psw=test_input($_POST['psw']);
						
			if(empty($mbl)){
				echo 'Mobile No. Required';
			}
			else if(!preg_match("/^[0-9]{10}+$/",$mbl)){
				echo 'Invalid Mobile No.';
			}
			else if(empty($c_psw)){
				echo 'Current Password Required';
			}
			else if(!preg_match("/^[a-zA-Z0-9\W_ ]{4,}+$/",$c_psw)){
				echo 'Invalid Current Password';
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
							if($mbl==$_SESSION['stu'] && $c_psw==$db_psw){
								update_psw($psw);
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