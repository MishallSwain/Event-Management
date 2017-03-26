<?php 
	include 'includes/database.php';
	$link = connect1();
	$eventId = $_GET['eid'];
	$userId = $_GET['id'];
	$error;
	$confirmed = 1;
	$countQuery = "SELECT count(a.id) AS count, e.id as eventid, e.capacity as capacity FROM registration as a, events as e WHERE a.event_id = e.id AND e.id = '$eventId'";
	$result = mysqli_query($link, $countQuery) or die('Error adding data');
	$row = mysqli_fetch_assoc($result);
	if(hasUserRegistered((int)$userId, (int)$eventId)){
		$query = "DELETE FROM registration WHERE event_id = '$eventId' AND user_id = '$userId'";
		if($row['count'] == $row['capacity'] + 1){
			$registerUserQuery = "SELECT user_id, MIN(datetime) FROM registration WHERE confirmed = 0 AND event_id = '$eventId'";
			$result = mysqli_query($link, $registerUserQuery) or die('Error querying data');
			$userRow = mysqli_fetch_assoc($result);
			$registerUserQuery = "UPDATE registration SET confirmed = 1 WHERE user_id = " . $userRow['user_id'] . " AND event_id = '$eventId'";
			mysqli_query($link, $registerUserQuery) or die('Error querying data');
		}
	}else{
		if($row['count'] >= $row['capacity']){
			$error = "The event queue is full. You're on hold! You're token number is " . ($row['count'] - $row['capacity'] + 1);
			$confirmed = 0;
		}
		$query = "INSERT INTO registration(user_id, event_id, confirmed) VALUES('$userId', '$eventId', '$confirmed')";	
	}
	mysqli_query($link, $query)
		or die('Error adding data');
	$errorString = $error?"?error=$error":"";
	header("location:profile.php$errorString");
?>