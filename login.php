<?php
include 'includes/database.php';
if (isset($_POST["email"]) && isset($_POST["password"])){

if (preg_match("/^([a-z]|[0-9])+@([a-z]|[0-9])+\.[a-z]{2,3}$/i", trim($_POST['email']))){   
	$valid = login($_POST['email'], $_POST['password']);
	//means that login will return true, and store that in a variable called valid
				
	if($valid == true){					
	//so if it is a valid login, then you start a session with two sessions,  
	session_start();
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['loggedin'] = true;

	header('location:profile.php');
	exit(); 
	// always call onto exit after redirects, because it stops the current script after it 
	}
}else {
	echo "<div class = 'container'>
			<h4>Failed Login</h4>
		</div>";
 	}
}
?>

<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link href="css/animate.css" rel="stylesheet" />
<link href="css/main.css" rel="stylesheet" />
<body>
	<div class="container">
		<h3 class = "animated fadeInDownBig"> Login page</h3>
		<hr>
		<div class="form-group animated fadeIn">
		<form action = "login.php" method = "POST" class = "form-inline">
			<label>Email</label>
			<input type ="text" name ="email" value = "">

			<label>Password</label>
			<input type ="password" name ="password" value = "">
			<input type ="submit" class = "btn btn-default" value ="login">
			<br>
			<br>
			<hr>
			<button class = "btn btn-default" formaction= "index.php">Back</button>
		</form>
	    </div>
    </div>
</body>
</html>