<?php

 	include('dataManipulation.php');

  	$fbid = $_GET['fbid'];
 
  	$query = 'SELECT  LocationID as lid, 
                    Title as title,
                    Latitude as lat,
                    Longitude as lon
                    FROM isLocated NATURAL JOIN Location WHERE FBid = ?';


  	global $mysqli;
  
 	$stmt = $mysqli->prepare($query);
 	$stmt->bind_param('s', $fbid);

    jsonify($stmt, 'locations');

?>