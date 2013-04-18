<?php

  	include('dataManipulation.php');

    if(isset($_GET['tdid']))
	{
	  	$tdid = $_GET['tdid'];
 
	  	$query = 'SELECT  EventID as eid, 
	                    ToDoID as tdid,
	                    Description as description,
	                    Title as title,
	                    Points as pts
	                    FROM Todo NATURAL JOIN Has WHERE ToDoID = ?';

	  	global $mysqli;
	  
	 	$stmt = $mysqli->prepare($query);
	 	$stmt->bind_param('s', $tdid);

	    jsonify($stmt, 'todo');

	}
	else if(isset($_POST['admin_fbid']))
	{
		$admin_fbid = $_POST['admin_fbid'];
		$title = $_POST['title'];
		$description = $_POST['description'];

		$getquery = 'INSERT INTO Todo VALUES(NULL, 0, ?, ?)';
		$hasquery = 'INSERT INTO Has VALUES(?, ?)';
		
		global $mysqli;
	  
	 	$stmt = $mysqli->prepare($query);
	 	$stmt->bind_param('sss', $admin_fbid, $title, $description);


	 	$query = 'SELECT  EventID AS eid, 
	                Admin AS admin_fbid, 
	                Title AS title
	                FROM Event WHERE EventID = ?;';

	    insertTodo($stmt, $query, $hasquery, 'event', $admin_fbid);

	}
?>