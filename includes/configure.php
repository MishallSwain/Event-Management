<?php
/**
* Assignment 2.
* 
* Provide configuration for database access 
* 
* @author Joshua Loo
* @date 2016-03-14
* @version 1
*/


	function connect(){
		
		$host = "localhost";
		$username = "root";
		$password = "password";
		$database = "assign2";

		$link = new mysqli($host, $username, $password, $database);
		//return the LINK
		return $link;
	}
	


?>