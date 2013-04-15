<?php

  	include('dataManipulation.php');

  	$fbid = $_GET['fbid'];
 
  	$query = 'SELECT  FBid as fbid, 
                    Email as email,
                    Name as name
                    FROM User WHERE FBid = ?';


  	global $mysqli;
  
 	$stmt = $mysqli->prepare($query);
 	$stmt->bind_param('s', $fbid);

    jsonify($stmt, 'user');

?>