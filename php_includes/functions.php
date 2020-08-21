<?php 
	
	function count_answers($q_id){
		$count=0;
		include('conx.php');
		if($stmt = $conn->prepare("SELECT count(*) FROM answers WHERE q_id=?")){
			if($stmt->bind_param("i", $q_id)){
				$stmt->execute();
				$stmt->bind_result($count);
				$stmt->fetch();
				echo 'Replies: '.$count;
				$stmt->close();
				$conn->close();
			}
		}
	}
	
	function single_ans($q_id){
		include('conx.php');
		if($stmt = $conn->prepare("SELECT answer FROM answers WHERE q_id=? ORDER BY add_date DESC, add_time DESC LIMIT 1")){
			if($stmt->bind_param("i", $q_id)){
				$stmt->execute();
				$stmt->bind_result($answer);
				if($stmt->fetch()){
					echo '<h6>'.nl2br($answer).'</h6>';
				}
				$stmt->close();
				$conn->close();
			}
		}
	}
	
	function get_likes($q_id){
		include('conx.php');
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
		include('conx.php');
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
	
	function like_or_dislike($q_id, $likes, $dislikes){
		include('conx.php');
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
	}
	
	
	//answers like or dislike functions now
	
	function get_a_likes($a_id){
		include('conx.php');
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
		include('conx.php');
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
	
	function ans_like_or_dislike($a_id, $a_likes, $a_dislikes){
		include('conx.php');
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
	}
	
?>