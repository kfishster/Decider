<?php

  	include('dataManipulation.php');

  	$fbid = $_GET['fbid'];

  	$query = 'SELECT 	EventID as eid, 
  						Title as title, 
  						Event.Admin as admin_fbid, 
  						Name as admin_name
  						FROM Event NATURAL JOIN Participates INNER JOIN User ON Event.Admin = User.FBid 
  						WHERE Participates.FBid = ?;';  


   	global $mysqli;
  
 	$stmt = $mysqli->prepare($query);
 	$stmt->bind_param('s', $fbid);

    jsonify($stmt, 'events');

?>