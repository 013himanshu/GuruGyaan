<?php 
session_start();

function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
}

function update_likes($q_id){
	$likes=1;
	$dislikes=0;
	include('../conx.php');
	if($stmt = $conn->prepare("INSERT INTO q_likes (ques_id, exp_mbl, likes, dislikes) VALUES (?,?,?,?)")){
		if($stmt->bind_param("isii", $q_id, $_SESSION['exp'], $likes, $dislikes)){
			$stmt->execute();
			echo 'success';
		}
	}
}

function update_likes_swap2like($q_id){
	$likes=1;
	$dislikes=0;
	include('../conx.php');
	if($stmt = $conn->prepare("UPDATE q_likes SET likes=?, dislikes=? WHERE ques_id=? AND exp_mbl=?")){
		if($stmt->bind_param("iiis", $likes, $dislikes, $q_id, $_SESSION['exp'])){
			$stmt->execute();
			echo 'success';
		}
	}
}

function update_likes_swap2dislike($q_id){
	$likes=0;
	$dislikes=1;
	include('../conx.php');
	if($stmt = $conn->prepare("UPDATE q_likes SET likes=?, dislikes=? WHERE ques_id=? AND exp_mbl=?")){
		if($stmt->bind_param("iiis", $likes, $dislikes, $q_id, $_SESSION['exp'])){
			$stmt->execute();
			echo 'success';
		}
	}
}

function update_likes_dlt($q_id){
	include('../conx.php');
	if($stmt = $conn->prepare("DELETE FROM q_likes WHERE ques_id=? AND exp_mbl=?")){
		if($stmt->bind_param("is", $q_id, $_SESSION['exp'])){
			$stmt->execute();
			echo 'success';
		}
	}
}

function update_dislikes($q_id){
	$likes=0;
	$dislikes=1;
	include('../conx.php');
	if($stmt = $conn->prepare("INSERT INTO q_likes (ques_id, exp_mbl, likes, dislikes) VALUES (?,?,?,?)")){
		if($stmt->bind_param("isii", $q_id, $_SESSION['exp'], $likes, $dislikes)){
			$stmt->execute();
			echo 'success';
		}
	}
}

if(isset($_SESSION['exp'])){
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		if(isset($_POST['q_id']) && isset($_POST['opt'])){
			$q_id=test_input($_POST['q_id']);
			$opt=test_input($_POST['opt']);
			
			if($_POST['opt']=="qe-like-w"){
				include('../conx.php');
				if($stmt = $conn->prepare("SELECT likes, dislikes FROM q_likes WHERE ques_id=? AND exp_mbl=?")){
					if($stmt->bind_param("is", $q_id, $_SESSION['exp'])){
						$stmt->execute();
						$stmt->bind_result($db_likes, $db_dislikes);
						if($stmt->fetch()){
							if($db_likes==0 && $db_dislikes==1){
								update_likes_swap2like($q_id);
							}
							if($db_likes==1 && $db_dislikes==0){
								update_likes_swap2dislike($q_id);
							}
						}
						else{
							update_likes($q_id);
						}
					}
				}
			}
			else if($_POST['opt']=="qe-like-b"){
				include('../conx.php');
				if($stmt = $conn->prepare("SELECT COUNT(*) FROM q_likes WHERE ques_id=? AND exp_mbl=?")){
					if($stmt->bind_param("is", $q_id, $_SESSION['exp'])){
						$stmt->execute();
						$stmt->bind_result($count);
						$stmt->fetch();
						if($count>0){
							update_likes_dlt($q_id);
						}
					}
				}
			}
			else if($_POST['opt']=="qe-dislike-w"){
				include('../conx.php');
				if($stmt = $conn->prepare("SELECT likes, dislikes FROM q_likes WHERE ques_id=? AND exp_mbl=?")){
					if($stmt->bind_param("is", $q_id, $_SESSION['exp'])){
						$stmt->execute();
						$stmt->bind_result($db_likes, $db_dislikes);
						if($stmt->fetch()){
							if($db_likes==0 && $db_dislikes==1){
								update_likes_swap2like($q_id);
							}
							if($db_likes==1 && $db_dislikes==0){
								update_likes_swap2dislike($q_id);
							}
						}
						else{
							update_dislikes($q_id);
						}
					}
				}
			}
			else if($_POST['opt']=="qe-dislike-b"){
				include('../conx.php');
				if($stmt = $conn->prepare("SELECT COUNT(*) FROM q_likes WHERE ques_id=? AND exp_mbl=?")){
					if($stmt->bind_param("is", $q_id, $_SESSION['exp'])){
						$stmt->execute();
						$stmt->bind_result($count);
						$stmt->fetch();
						if($count>0){
							update_likes_dlt($q_id);
						}
					}
				}
			}
			
		}
	}
}

?>