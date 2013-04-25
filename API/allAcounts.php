<?php

include('dataManipulation.php');
	   
	 	$query = 'SELECT  
	 				FBid as id
	                FROM User;';  


		global $mysqli;
	  
	 	$stmt = $mysqli->prepare($query);

	    jsonify($stmt, 'users');
?>