<?php

  	include('dataManipulation.php');

  	$eid = $_GET['eid'];
 
  	$query = 'SELECT  FBid as fbid, 
                    Email as email,
                    Name as name
                    FROM Event NATURAL JOIN Participates NATURAL JOIN User WHERE Event.EventID = ?';


  	global $mysqli;
  
 	$stmt = $mysqli->prepare($query);
 	$stmt->bind_param('s', $eid);

    jsonify($stmt, 'users');

?>