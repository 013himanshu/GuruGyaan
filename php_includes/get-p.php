<?php 
session_start();

	function get_a_likes($a_id){
		include('../conx.php');
		if($stmt = $conn->prepare("SELECT COUNT(*) FROM a_likes WHERE likes=1 AND dislikes=0 AND ans_id=?")){
			if($stmt->bind_param("i", $a_id)){
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
	
	function get_a_dislikes($a_id){
		include('../conx.php');
		if($stmt = $conn->prepare("SELECT COUNT(*) FROM a_likes WHERE likes=0 AND dislikes=1 AND ans_id=?")){
			if($stmt->bind_param("i", $a_id)){
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

$a_id=$_POST['a_id'];

$a_likes=get_a_likes($a_id);
$a_dislikes=get_a_dislikes($a_id);



		
		include('../conx.php');
		if($stmt = $conn->prepare("SELECT likes, dislikes FROM a_likes WHERE ans_id=? AND stu_mbl=?")){
			if($stmt->bind_param("is", $a_id, $_SESSION['stu'])){
				$stmt->execute();
				$stmt->bind_result($count_likes, $count_dislikes);
				if($stmt->fetch()){
					if($count_likes==1){
						if(isset($_SESSION['stu'])){echo '<i class="fa fa-thumbs-up as-like-b" aria-hidden="true" a_id="'.$a_id.'" style="cursor:pointer;"></i>'.$a_likes.' <i class="fa fa-thumbs-o-down as-dislike-w" aria-hidden="true" a_id="'.$a_id.'" style="cursor:pointer;"></i>'.$a_dislikes;}else{echo '<i class="<i class="fa fa-thumbs-o-up" aria-hidden="true" a_id="'.$a_id.'" style="cursor:pointer;"></i>'.$a_likes.' <i class="fa fa-thumbs-o-down" aria-hidden="true" a_id="'.$a_id.'" style="cursor:pointer;"></i>'.$a_dislikes;}
					}
					else if($count_dislikes==1){
						if(isset($_SESSION['stu'])){echo '<i class="fa fa-thumbs-o-up as-like-w" aria-hidden="true" a_id="'.$a_id.'" style="cursor:pointer;"></i>'.$a_likes.' <i class="fa fa-thumbs-down as-dislike-b" aria-hidden="true" a_id="'.$a_id.'" style="cursor:pointer;"></i>'.$a_dislikes;}else{echo '<i class="<i class="fa fa-thumbs-o-up" aria-hidden="true" a_id="'.$a_id.'" style="cursor:pointer;"></i>'.$a_likes.' <i class="fa fa-thumbs-o-down" aria-hidden="true" a_id="'.$a_id.'" style="cursor:pointer;"></i>'.$a_dislikes;}
					}
				}
				else{
					echo '<i class="fa fa-thumbs-o-up as-like-w" aria-hidden="true" a_id="'.$a_id.'" style="cursor:pointer;"></i>'.$a_likes.' <i class="fa fa-thumbs-o-down as-dislike-w" aria-hidden="true" a_id="'.$a_id.'" style="cursor:pointer;"></i>'.$a_dislikes;
				}
			}	
		}
	

?>