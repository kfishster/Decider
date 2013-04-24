<?php

  	include('dataManipulation.php');

  	$fbid = $_GET['fbid'];

  	$query = 'SELECT 	EventID AS eid, 
  					Admin AS admin_fbid, 
  					Title as title,
  					Name as admin_name 
  					FROM Event NATURAL JOIN User NATURAL JOIN Participates WHERE FBid = ?;';  


   	global $mysqli;
  
 	$stmt = $mysqli->prepare($query);
 	$stmt->bind_param('s', $fbid);

    jsonify($stmt, 'events');

?>