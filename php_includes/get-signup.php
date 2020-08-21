<?php 
	session_start();
	
	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);		
		return $data;
	}

	if($_SERVER["REQUEST_METHOD"]=="POST"){
		if(isset($_POST["stu_btn"]) && $_POST['stu_btn']=="stu_sign"){
			$fname=test_input($_POST['fname']);
			$lname=test_input($_POST['lname']);
			$mbl=test_input($_POST['mbl']);
			$email=test_input($_POST['email']);	
			$psw=test_input($_POST['psw']);
			
			if(empty($fname)){
				echo 'First Name Required';
			}
			else if(!preg_match("/^[a-zA-Z\.()_,\- ]+$/",$fname)){
				echo 'Invalid First Name';
			}
			else if(empty($lname)){
				echo 'Last Name Required';
			}
			else if(!preg_match("/^[a-zA-Z\.()_,\- ]+$/",$lname)){
				echo 'Invalid Last Name';
			}
			else if(empty($mbl)){
				echo 'Mobile No. Required';
			}
			else if(!preg_match("/^[0-9]{10}+$/",$mbl)){
				echo 'Invalid Mobile No.';
			}
			else if(empty($email)){
				echo 'Email Required';
			}
			else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				echo 'Invalid Email';
			}
			else if(empty($psw)){
				echo 'Password Required';
			}
			else if(!preg_match("/^[a-zA-Z0-9\W_ ]{4,}+$/",$psw)){
				echo 'Invalid Password';
			}
			else{
				include('../conx.php');
				if($stmt = $conn->prepare("SELECT mbl FROM student WHERE mbl=?")){
					if($stmt->bind_param("s", $mbl)){
						$stmt->execute();
						$stmt->bind_result($db_mbl);
						if($stmt->fetch()){
							echo 'An account already exists with this mobile no.';
							$stmt->close();
							$conn->close();
						}
						else{
							include('../conx.php');
				
							date_default_timezone_set("Asia/Kolkata");
							$date=$time="";
							$date=date("Y-m-d");				
							$time=date("h:i:sa");
								
							if($stmt = $conn->prepare("INSERT INTO student (fname, lname, mbl, email, psw, add_date, add_time) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
								if($stmt->bind_param("sssssss", $fname, $lname, $mbl, $email, $psw, $date, $time)){
									$stmt->execute();									
									$_SESSION["stu"]=$mbl;
									$stmt->close();
									$conn->close();									
									echo 'success';
								}
							}
						}
					}
				}
				
			}
			
			
		}
		if(isset($_POST["exp_btn"]) && $_POST['exp_btn']=="exp_sign"){
			$fname=test_input($_POST['fname']);
			$lname=test_input($_POST['lname']);
			$mbl=test_input($_POST['mbl']);
			$email=test_input($_POST['email']);	
			$psw=test_input($_POST['psw']);
			
			if(empty($fname)){
				echo 'First Name Required';
			}
			else if(!preg_match("/^[a-zA-Z\.()_,\- ]+$/",$fname)){
				echo 'Invalid First Name';
			}
			else if(empty($lname)){
				echo 'Last Name Required';
			}
			else if(!preg_match("/^[a-zA-Z\.()_,\- ]+$/",$lname)){
				echo 'Invalid Last Name';
			}
			else if(empty($mbl)){
				echo 'Mobile No. Required';
			}
			else if(!preg_match("/^[0-9]{10}+$/",$mbl)){
				echo 'Invalid Mobile No.';
			}
			else if(empty($email)){
				echo 'Email Required';
			}
			else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				echo 'Invalid Email';
			}
			else if(empty($psw)){
				echo 'ePassword Required';
			}
			else if(!preg_match("/^[a-zA-Z0-9\W_ ]{4,}+$/",$psw)){
				echo 'Invalid Password';
			}
			else{
				include('../conx.php');
				if($stmt = $conn->prepare("SELECT mbl FROM expert WHERE mbl=?")){
					if($stmt->bind_param("s", $mbl)){
						$stmt->execute();
						$stmt->bind_result($db_mbl);
						if($stmt->fetch()){
							echo 'An account already exists with this mobile no.';
							$stmt->close();
							$conn->close();
						}
						else{
							include('../conx.php');
				
							date_default_timezone_set("Asia/Kolkata");
							$date=$time="";
							$date=date("Y-m-d");				
							$time=date("h:i:sa");
								
							if($stmt = $conn->prepare("INSERT INTO expert (fname, lname, mbl, email, psw, add_date, add_time) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
								if($stmt->bind_param("sssssss", $fname, $lname, $mbl, $email, $psw, $date, $time)){
									$stmt->execute();									
									$_SESSION["exp"]=$mbl;
									$stmt->close();
									$conn->close();									
									echo 'success';
								}
							}
						}
					}
				}
				
			}
			
			
		}
	}
?>