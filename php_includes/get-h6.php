<?php 
session_start();

	function get_likes($q_id){
		include('../conx.php');
		if($stmt = $conn->prepare("SELECT COUNT(*) FROM q_likes WHERE likes=1 AND dislikes=0 AND ques_id=?")){
			if($stmt->bind_param("i", $q_id)){
				$stmt->execute();
				$stmt->bind_result($likes);
				if($stmt->fetch()){
					return $likes;
				}
				else{
					return 0;
				}
				$stmt->close();
				$conn->close();
			}
		}
	}
	
	function get_dislikes($q_id){
		include('../conx.php');
		if($stmt = $conn->prepare("SELECT COUNT(*) FROM q_likes WHERE likes=0 AND dislikes=1 AND ques_id=?")){
			if($stmt->bind_param("i", $q_id)){
				$stmt->execute();
				$stmt->bind_result($dislikes);
				if($stmt->fetch()){
					return $dislikes;
				}
				else{
					return 0;
				}
				$stmt->close();
				$conn->close();
			}
		}
	}

$q_id=$_POST['q_id'];

$likes=get_likes($q_id);
$dislikes=get_dislikes($q_id);



		include('../conx.php');
		if($stmt = $conn->prepare("SELECT likes, dislikes FROM q_likes WHERE ques_id=? AND exp_mbl=?")){
			if($stmt->bind_param("is", $q_id, $_SESSION['exp'])){
				$stmt->execute();
				$stmt->bind_result($count_likes, $count_dislikes);
				if($stmt->fetch()){
					if($count_likes==1){
						if(isset($_SESSION['exp'])){echo '<i class="fa fa-thumbs-up qe-like-b" aria-hidden="true" q_id="'.$q_id.'" style="cursor:pointer;"></i>'.$likes.' <i class="fa fa-thumbs-o-down qe-dislike-w" aria-hidden="true" q_id="'.$q_id.'" style="cursor:pointer;"></i>'.$dislikes;}else{echo '<i class="<i class="fa fa-thumbs-o-up" aria-hidden="true" q_id="'.$q_id.'" style="cursor:pointer;"></i>'.$likes.' <i class="fa fa-thumbs-o-down" aria-hidden="true" q_id="'.$q_id.'" style="cursor:pointer;"></i>'.$dislikes;}
					}
					else if($count_dislikes==1){
						if(isset($_SESSION['exp'])){echo '<i class="fa fa-thumbs-o-up qe-like-w" aria-hidden="true" q_id="'.$q_id.'" style="cursor:pointer;"></i>'.$likes.' <i class="fa fa-thumbs-down qe-dislike-b" aria-hidden="true" q_id="'.$q_id.'" style="cursor:pointer;"></i>'.$dislikes;}else{echo '<i class="<i class="fa fa-thumbs-o-up" aria-hidden="true" q_id="'.$q_id.'" style="cursor:pointer;"></i>'.$likes.' <i class="fa fa-thumbs-o-down" aria-hidden="true" q_id="'.$q_id.'" style="cursor:pointer;"></i>'.$dislikes;}
					}
				}
				else{
					echo '<i class="fa fa-thumbs-o-up qe-like-w" aria-hidden="true" q_id="'.$q_id.'" style="cursor:pointer;"></i>'.$likes.' <i class="fa fa-thumbs-o-down qe-dislike-w" aria-hidden="true" q_id="'.$q_id.'" style="cursor:pointer;"></i>'.$dislikes;
				}
			}	
		}

?>