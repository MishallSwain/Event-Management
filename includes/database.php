<?php
include "includes/configure.php";

	function login($email, $password){
		$link = connect();
		$query = "select * from users where email = '". $email ."'and password = '". $password ."'";
		$results = mysqli_query($link, $query);
		$row = mysqli_fetch_array($results);
		if (count($row)){
			return true;
		}else{
			return false;
		}
	}

	function save($data){
		$link = connect();
		$query = "insert into users values(
			null,
			'" .$data['password'] ."' ,
			'" .$data['firstname'] ."',
			'" .$data['lastname'] ."' ,
			'" .$data['email'] ."' ,
			null
		)";
		mysqli_query($link, $query);
	}

	function getProfile($email){		
		$link = connect();
		$query = "select * from users where email = '$email' ";	
		$results = mysqli_query($link, $query);
		$row = mysqli_fetch_array($results);
		$profile['firstname'] = $row['firstname'] ;
		$profile['lastname'] = $row['lastname'];
		$profile['email'] = $row['email'];
		$profile['id'] = $row['id'];
		return $profile;
	}
		
	function getUser($id){			
		$link = connect();
		$query = "select * from users where id = '$email' ";
		$results = mysqli_query($link, $query);
		$row = mysqli_fetch_array($results);
		$profile['firstname'] = $row['firstname'] ;
		$profile['lastname'] = $row['lastname'];
		$profile['email'] = $row['email'];
		$profile['id'] = $row['id'];
		return $profile;
	}
			
	
	function hasUserRegistered($userId, $eventId){
		$link = connect();
		$registeredUsers = array();
		$query = "SELECT user_id, event_id FROM registration";
		$result = mysqli_query($link, $query);
		while($row = mysqli_fetch_array($result)){
			$registeredUsers[$row['event_id']][] = $row['user_id'];
		}
		$userRegistrationsQuery = "SELECT e.name, a.event_id, a.confirmed FROM registration as a, events as e WHERE a.event_id = e.id AND a.user_id = ".$userId;
		$result = mysqli_query($link, $userRegistrationsQuery);
		$userRegistrations = array();
		$userRegistrationTemp = array();
		while($row = mysqli_fetch_array($result)){
			$userRegistrationTemp["name"] = $row["name"];
			$userRegistrationTemp["event_id"] = $row["event_id"];
			$userRegistrationTemp["confirmed"] = $row["confirmed"];
			$userRegistrations[] = $userRegistrationTemp;
		}
		
		if(array_key_exists($eventId, $registeredUsers)){
			if(in_array($userId, $registeredUsers[$eventId])){
				return true;
			}
		}

		return false;
	}
	
	function connect1(){
		$link = connect();
		return $link;
	}

	function UserConfirms($userId, $eventId){
		$link = connect();
		$registeredUsers = array();
		$query = "SELECT user_id, event_id FROM registration";
		$result = mysqli_query($link, $query);
		while($row = mysqli_fetch_array($result)){
			$registeredUsers[$row['event_id']][] = $row['user_id'];
		}
		$userRegistrationsQuery = "SELECT e.name, a.event_id, a.confirmed FROM registration as a, events as e WHERE a.event_id = e.id AND a.user_id = ".$userId;
		$result = mysqli_query($link, $userRegistrationsQuery);
		$userRegistrations = array();
		$userRegistrationTemp = array();
		while($row = mysqli_fetch_array($result)){
			$userRegistrationTemp["name"] = $row["name"];
			$userRegistrationTemp["event_id"] = $row["event_id"];
			$userRegistrationTemp["confirmed"] = $row["confirmed"];
			$userRegistrations[] = $userRegistrationTemp;
		}
		
		if(array_key_exists($eventId, $registeredUsers)){
			if(in_array($userId, $registeredUsers[$eventId])){
				foreach($userRegistrations as $userRegistration){
					if($userRegistration['event_id']==$eventId){
					echo  $userRegistration['confirmed']?" Confirmed":" Not confirmed";
					}
				}
			}
		}
	}
?>