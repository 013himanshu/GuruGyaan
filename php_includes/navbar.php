<?php 
	
	if(isset($_SESSION['stu'])){
		include('conx.php');			
		if($stmt = $conn->prepare("SELECT fname FROM student WHERE mbl=? LIMIT 1")) {
			if($stmt->bind_param("s", $_SESSION['stu'])){
				$stmt->execute();
				$stmt->bind_result($sname);
				$stmt->fetch();															
			}
		}
	}
	if(isset($_SESSION['exp'])){
		include('conx.php');			
		if($stmt = $conn->prepare("SELECT fname FROM expert WHERE mbl=? LIMIT 1")) {
			if($stmt->bind_param("s", $_SESSION['exp'])){
				$stmt->execute();
				$stmt->bind_result($ename);
				$stmt->fetch();															
			}
		}
	}
	
	if(isset($_SESSION['stu'])){
		echo '<div class="navbar-fixed content">
			<ul id="stu_my_ac" class="dropdown-content">
			  <li><a href="stu-content.php">My Content</a></li>
			  <li><a href="stu-change-password.php">Change Password</a></li>			 
			  <li><a href="logout.php">Logout</a></li>
			</ul>
			<nav class="blue lighten-1">
				<div class="nav-wrapper">
				  <a href="index.php" class="brand-logo"><img src="images/wide-guru-gyaan-logo-white.png" class="logo" /></a>
				  <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
				  <ul class="right hide-on-med-and-down">
					<li class="li-home"><a href="index.php" class="waves-effect waves-light">Home</a></li>
					<li class="li-read"><a href="read.php" class="waves-effect waves-light">Read</a></li>
					<li class="li-ask"><a href="ask.php" class="waves-effect waves-light">Ask</a></li>					
					<li class="li-my-ac"><a class="dropdown-button" href="#" data-activates="stu_my_ac">Hi, '.$sname.'<i class="material-icons right">arrow_drop_down</i></a></li>
				  </ul>
				  <ul class="side-nav" id="mobile-demo">
					<li class="li-home"><a href="index.php" class="waves-effect waves-light">Home</a></li>
					<li class="li-read"><a href="read.php" class="waves-effect waves-light">Read</a></li>
					<li class="li-ask"><a href="ask.php" class="waves-effect waves-light">Ask</a></li>
					<li class="li-content"><a href="stu-content.php" class="waves-effect waves-light">My Content</a></li>
					<li class="li-psw"><a href="stu-change-password.php" class="waves-effect waves-light">Change Password</a></li>
					<li><a href="logout.php" class="waves-effect waves-light">Logout</a></li>
				  </ul>
				</div>
			  </nav>
		</div>';	
	}
	else if(isset($_SESSION['exp'])){
		echo '<div class="navbar-fixed content">
			<ul id="stu_my_ac" class="dropdown-content">
			  <li><a href="exp-content.php">My Content</a></li>
			  <li><a href="exp-change-password.php">Change Password</a></li>			 
			  <li><a href="logout.php">Logout</a></li>
			</ul>
			<nav class="blue lighten-1">
				<div class="nav-wrapper">
				  <a href="index.php" class="brand-logo"><img src="images/wide-guru-gyaan-logo-white.png" class="logo" /></a>
				  <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
				  <ul class="right hide-on-med-and-down">
					<li class="li-home"><a href="index.php" class="waves-effect waves-light">Home</a></li>
					<li class="li-read"><a href="read.php" class="waves-effect waves-light">Read</a></li>					
					<li class="li-my-ac"><a class="dropdown-button" href="#" data-activates="stu_my_ac">Hi, '.$ename.'<i class="material-icons right">arrow_drop_down</i></a></li>
				  </ul>
				  <ul class="side-nav" id="mobile-demo">
					<li class="li-home"><a href="index.php" class="waves-effect waves-light">Home</a></li>
					<li class="li-read"><a href="read.php" class="waves-effect waves-light">Read</a></li>	
					<li class="li-content"><a href="exp-content.php" class="waves-effect waves-light">My Content</a></li>
					<li class="li-psw"><a href="exp-change-password.php" class="waves-effect waves-light">Change Password</a></li>
					<li><a href="logout.php" class="waves-effect waves-light">Logout</a></li>
				  </ul>
				</div>
			  </nav>
		</div>';		
	}
	else{
		echo '<div class="navbar-fixed content">
			<nav class="blue lighten-1">
				<div class="nav-wrapper">
				  <a href="index.php" class="brand-logo"><img src="images/wide-guru-gyaan-logo-white.png" class="logo" /></a>
				  <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
				  <ul class="right hide-on-med-and-down">
					<li class="li-home"><a href="index.php" class="waves-effect waves-light">Home</a></li>					
					<li class="li-ques"><a href="read.php" class="waves-effect waves-light">Questions</a></li>
					<li class="li-login"><a href="login.php" class="waves-effect waves-light">Login</a></li>
					<li class="li-signup"><a href="signup.php" class="waves-effect waves-light">Signup</a></li>
				  </ul>
				  <ul class="side-nav" id="mobile-demo">
					<li class="li-home"><a href="index.php" class="waves-effect waves-light">Home</a></li>					
					<li class="li-ques"><a href="read.php" class="waves-effect waves-light">Questions</a></li>
					<li class="li-login"><a href="login.php" class="waves-effect waves-light">Login</a></li>
					<li class="li-signup"><a href="signup.php" class="waves-effect waves-light">Signup</a></li>
				  </ul>
				</div>
			  </nav>
		</div>';
	}
	
?>