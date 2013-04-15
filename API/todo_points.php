<?php

  	include('dataManipulation.php');

    if(isset($_POST['tdid']))
	{
	  	$tdid = $_POST['tdid'];
	  	$fbid = $_POST['fbid'];

	  	$query = 'SELECT * FROM Points WHERE ToDoID= ? AND FBid = ?;';
	  	$stmt = $mysqli->prepare($query);
	 	$stmt->bind_param('ss', $tdid, $fbid);

	 	if(exists($stmt))
	 		$query = 'UPDATE Points SET Point= Point + 1 WHERE ToDoID= ? AND FBid = ?;';
	 	else
	 	 	$query = 'INSERT INTO Points VALUES(?, ?, 1);';

	  	global $mysqli;

	  	$stmt = $mysqli->prepare($query);
	 	$stmt->bind_param('ss', $tdid, $fbid);
	 	$stmt->execute();
      
	    $query = 'UPDATE Todo SET Points= Points + 1 WHERE ToDoID= ?;';   

	  
	 	$stmt = $mysqli->prepare($query);
	 	$stmt->bind_param('s', $tdid);

	    runWithoutOutput($stmt);

	}
	if(isset($_GET['tdid']))
	{
	  	$tdid = $_GET['tdid'];
	  	$fbid = $_GET['fbid'];

	  	$query = 'SELECT * FROM Points WHERE ToDoID= ? AND FBid = ?;';
	  	$stmt = $mysqli->prepare($query);
	 	$stmt->bind_param('ss', $tdid, $fbid);

	 	if(exists($stmt))
	 		$query = 'UPDATE Points SET Point= Point + 1 WHERE ToDoID= ? AND FBid = ?;';
	 	else
	 	 	$query = 'INSERT INTO Points VALUES(?, ?, -1);';
	  	
	  	global $mysqli;

	  	$stmt = $mysqli->prepare($query);
	 	$stmt->bind_param('ss', $tdid, $fbid);
	 	$stmt->execute();
      
	    $query = 'UPDATE Todo SET Points= Points - 1 WHERE ToDoID= ?;';   

	  
	 	$stmt = $mysqli->prepare($query);
	 	$stmt->bind_param('s', $tdid);

	    runWithoutOutput($stmt);

	}
?>