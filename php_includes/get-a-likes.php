<?php 
session_start();

function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);		
	return $data;
}

function update_a_likes($a_id){
	$likes=1;
	$dislikes=0;
	include('../conx.php');
	if($stmt = $conn->prepare("INSERT INTO a_likes (ans_id, stu_mbl, likes, dislikes) VALUES (?,?,?,?)")){
		if($stmt->bind_param("isii", $a_id, $_SESSION['stu'], $likes, $dislikes)){
			$stmt->execute();
			echo 'success';
		}
	}
}

function update_a_likes_swap2like($a_id){
	$likes=1;
	$dislikes=0;
	include('../conx.php');
	if($stmt = $conn->prepare("UPDATE a_likes SET likes=?, dislikes=? WHERE ans_id=? AND stu_mbl=?")){
		if($stmt->bind_param("iiis", $likes, $dislikes, $a_id, $_SESSION['stu'])){
			$stmt->execute();
			echo 'success';
		}
	}
}

function update_a_likes_swap2dislike($a_id){
	$likes=0;
	$dislikes=1;
	include('../conx.php');
	if($stmt = $conn->prepare("UPDATE a_likes SET likes=?, dislikes=? WHERE ans_id=? AND stu_mbl=?")){
		if($stmt->bind_param("iiis", $likes, $dislikes, $a_id, $_SESSION['stu'])){
			$stmt->execute();
			echo 'success';
		}
	}
}

function update_a_likes_dlt($a_id){
	include('../conx.php');
	if($stmt = $conn->prepare("DELETE FROM a_likes WHERE ans_id=? AND stu_mbl=?")){
		if($stmt->bind_param("is", $a_id, $_SESSION['stu'])){
			$stmt->execute();
			echo 'success';
		}
	}
}

function update_a_dislikes($a_id){
	$likes=0;
	$dislikes=1;
	include('../conx.php');
	if($stmt = $conn->prepare("INSERT INTO a_likes (ans_id, stu_mbl, likes, dislikes) VALUES (?,?,?,?)")){
		if($stmt->bind_param("isii", $a_id, $_SESSION['stu'], $likes, $dislikes)){
			$stmt->execute();
			echo 'success';
		}
	}
}

if(isset($_SESSION['stu'])){
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		if(isset($_POST['a_id']) && isset($_POST['opt'])){
			$a_id=test_input($_POST['a_id']);
			$opt=test_input($_POST['opt']);
			
			if($_POST['opt']=="as-like-w"){
				include('../conx.php');
				if($stmt = $conn->prepare("SELECT likes, dislikes FROM a_likes WHERE ans_id=? AND stu_mbl=?")){
					if($stmt->bind_param("is", $a_id, $_SESSION['stu'])){
						$stmt->execute();
						$stmt->bind_result($db_likes, $db_dislikes);
						if($stmt->fetch()){
							if($db_likes==0 && $db_dislikes==1){
								update_a_likes_swap2like($a_id);
							}
							if($db_likes==1 && $db_dislikes==0){
								update_a_likes_swap2dislike($a_id);
							}
						}
						else{
							update_a_likes($a_id);
						}
					}
				}
			}
			else if($_POST['opt']=="as-like-b"){
				include('../conx.php');
				if($stmt = $conn->prepare("SELECT COUNT(*) FROM a_likes WHERE ans_id=? AND stu_mbl=?")){
					if($stmt->bind_param("is", $a_id, $_SESSION['stu'])){
						$stmt->execute();
						$stmt->bind_result($count);
						$stmt->fetch();
						if($count>0){
							update_a_likes_dlt($a_id);
						}
					}
				}
			}
			else if($_POST['opt']=="as-dislike-w"){
				include('../conx.php');
				if($stmt = $conn->prepare("SELECT likes, dislikes FROM a_likes WHERE ans_id=? AND stu_mbl=?")){
					if($stmt->bind_param("is", $a_id, $_SESSION['stu'])){
						$stmt->execute();
						$stmt->bind_result($db_likes, $db_dislikes);
						if($stmt->fetch()){
							if($db_likes==0 && $db_dislikes==1){
								update_a_likes_swap2like($a_id);
							}
							if($db_likes==1 && $db_dislikes==0){
								update_a_likes_swap2dislike($a_id);
							}
						}
						else{
							update_a_dislikes($a_id);
						}
					}
				}
			}
			else if($_POST['opt']=="as-dislike-b"){
				include('../conx.php');
				if($stmt = $conn->prepare("SELECT COUNT(*) FROM a_likes WHERE ans_id=? AND stu_mbl=?")){
					if($stmt->bind_param("is", $a_id, $_SESSION['stu'])){
						$stmt->execute();
						$stmt->bind_result($count);
						$stmt->fetch();
						if($count>0){
							update_a_likes_dlt($a_id);
						}
					}
				}
			}
			
		}
	}
}

?>