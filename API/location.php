<?php

include('dataManipulation.php');
$lid = $_GET['lid'];
	   
	 	$query = 'SELECT  
	 				Title AS title, 
	                Street_Address AS address, 
	                City AS city,
	                State AS state,
	                Longitude AS lon,
	                Latitude AS lat
	                FROM Location WHERE LocationID = ?;';  


		global $mysqli;
	  
	 	$stmt = $mysqli->prepare($query);
	 	$stmt->bind_param('s', $lid);

	    jsonify($stmt, 'location');
?>