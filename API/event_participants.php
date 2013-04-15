<?php

  	include('dataManipulation.php');

    if(isset($_GET['eid']))
	{
	  	$eid = $_GET['eid'];
	  	$fbid = $_GET['fbid'];
 
	  	$query = 'INSERT INTO Participates VALUES(?, ?)';

	  	global $mysqli;
	  
	 	$stmt = $mysqli->prepare($query);
	 	$stmt->bind_param('ss', $fbid, $eid);

	    runWithoutOutput($stmt);

	}
	if(isset($_POST['eid']))
	{
	  	$eid = $_POST['eid'];
	  	$fbid = $_POST['fbid'];
 
	  	$query = 'DELETE FROM Participates WHERE FBid = ? AND EventID = ?';

	  	global $mysqli;
	  
	 	$stmt = $mysqli->prepare($query);
	 	$stmt->bind_param('ss', $fbid, $eid);

	    runWithoutOutput($stmt);

	}
?>