<?php
	
	include('dataManipulation.php');

	if(isset($_GET['eid']))
	{
	  	$eid = $_GET['eid'];
	   
	 	$query = 'SELECT  EventID AS eid, 
	                Admin AS admin_fbid, 
	                Title AS title
	                FROM Event WHERE EventID = ?;';  


		global $mysqli;
	  
	 	$stmt = $mysqli->prepare($query);
	 	$stmt->bind_param('s', $eid);

	    jsonify($stmt, 'event');
	}
	else if(isset($_POST['adminfbid']))
	{
		$admin_fbid = $_POST['adminfbid'];
		$title = $_POST['title'];
		$description = $_POST['description'];

		$query = 'INSERT INTO Event VALUES(NULL, ?, ?, NULL, ?)';

		global $mysqli;
	  
	 	$stmt = $mysqli->prepare($query);
	 	$stmt->bind_param('sss', $admin_fbid, $title, $description);


	 	$query = 'SELECT  EventID AS eid, 
	                Admin AS admin_fbid, 
	                Title AS title
	                FROM Event WHERE EventID = ?;';

	    insert($stmt, $query, 'event');

	}

?>