<?php
session_start();

include 'includes/database.php';
if (!isset($_SESSION['loggedin'])){
	header('location:login.php');
	exit();
}
else{
	//get the element from the array 
	$user = getProfile($_SESSION['email']);
}
?>

<!DOCTYPE html>
<html>
<title>Profile Page</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link href="css/main.css" rel="stylesheet" />
<link href="css/animate.css" rel="stylesheet" />
<style>
		img{
			width:250px;
			height:250px;
		}
		#logout{
			float: right;
			transform: translateY(-120%);
			z-index: -1;
		}
</style>
	<div class="container">
	<h2 class = "animated fadeInDownBig"> Profile Page</h2>
	<a href = "Logout.php" class ="btn btn-default" id="logout">Logout</a>
	<hr>
	<h3 class = "animated fadeInRight name">Welcome, <?php echo $user['firstname'] . ' ' . $user['lastname'];?></h3>
	<h4 class = "animated fadeInRight email"><?php echo $user['email'];?></h4>
	<hr>
	<h3 class = "animated fadeInRight event-header">Events</h3>
	<?php
		$link = connect1();
		$query = "SELECT * FROM events";
		$result = mysqli_query($link, $query);
		while($row = mysqli_fetch_array($result)){
	?> 	
		<p class = "animated fadeInRight event">
			<strong><?php 
						echo $row['name'].":";
						if(hasUserRegistered($user['id'], $row['id'])){
							UserConfirms($user['id'], $row['id']);
						}
					?></strong>
			<span><?php echo "<br>On ".$row['date']."<br>" ?></span>
			<span><?php echo "Location: ".$row['location']."<br>" ?></span>
			<a href="./register.php?eid=<?php echo $row['id']; ?>&id=<?php echo $user['id']; ?>"><?php echo hasUserRegistered($user['id'], $row['id'])?"Unsubscribe":"Subscribe";?></a>
		</p>
	<?php
		}
		if(isset($_GET)&&isset($_GET['error'])){
			echo $_GET['error'];
		}
	?>
	<hr>
</div>
</html>