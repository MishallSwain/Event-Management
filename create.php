<?php
//keep count of how many fields in the forms are valid 
$valid = 0;
include 'includes/database.php';
if (isset($_POST["submit"])) {
	//email validation
	if (preg_match("/^([a-z]|[0-9]|[A-Z})+@([a-z]|[0-9])+\.[a-z]{2,3}$/i", trim($_POST['email']))){   
		// echo "set email <br>";
		$valid = $valid + 1;
	}
	else{
		echo "
		<h4> Invalid email format</h4>
		";
	}
	//first name validation 
	if (preg_match("/^([a-z]|[0-9]){2,20}$/i", trim($_POST['firstname']))){   
		// echo "set first name <br>";
		$valid = $valid + 1;
	}
	else{
		echo "
		<h4> Invalid name</h4>
		";
	}			
	//last name validation 
	if (preg_match("/^([a-z]|[0-9]){2,20}$/i", trim($_POST['firstname']))){   
		// echo "set last name <br>";
		$valid = $valid + 1;
	}
	else{
		echo "
		<h4> Invalid name</h4>
	    ";
	}			
	//password validation 
	if (preg_match("/^([a-z]|[0-9]){6,15}$/i", trim($_POST['password']))){   
		// echo "set password <br>";
		$valid = $valid + 1;
    }
	else{
		echo "
		<h4> Invalid password format</h4>
	    ";
	}	
};//ends isset SUBMIT

//if the user has filled in everything succesfully 
if ($valid == 4){
	//passes the information from the form and puts it into the $data array  				
	$data['password'] = $_POST['password'] ;
	$data['firstname'] = $_POST['firstname'] ;
	$data['lastname'] = $_POST['lastname'];
	$data['email'] = $_POST['email'] ;
		
	//call the function 'save'
	save($data);
	
	//start session if everything is valid 
	session_start();
	$_SESSION['loggedin'] = true;
	$_SESSION['email'] = $_POST['email'];
		
	header('location:profile.php');
	exit();
}		
?>

<!DOCTYPE html>
<html>
<head>	
	<title>Create Profile</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link href="css/animate.css" rel="stylesheet" />
<link href="css/main.css" rel="stylesheet" />
</head>
<body>
	<div class="container">
		<h2 class = "animated fadeInDownBig"> Create Profile</h2>
		<hr>
		<form action ='' method = 'post' enctype='multipart/form-data'  class = "animated fadeIn form">
			<div class="form-group">
			    <label>Email:</label><br>
			    <input type="email"  name = 'email' value = "">
	        </div>
			<div class="form-group">
				<label>First Name:</label><br>
				<input type="text"  name = 'firstname' value = "">
			</div>				  
		    <div class="form-group">
				<label>Last Name:</label><br>
				<input type="text" name = 'lastname' value = "">
		    </div>
		    <div class="form-group">
				<label>Set Password:</label><br>
				<input type="password" name = 'password' value = "">
		    </div>
		    <button type ="submit" name ="submit"class="btn btn-default">Submit</button> 
		    <button type ="submit" class ="btn btn-default" formaction ="index.php">Back</button>
		</form>		
	</div>
</body>
</html>