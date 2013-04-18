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
	else if(isset($_POST['eid']))
	{
		$eid = $_POST['eid'];
		$title = $_POST['title'];
		$description = $_POST['description'];

		$query = 'INSERT INTO Todo VALUES(NULL, 0, ?, ?)';
		$hasquery = 'INSERT INTO Has VALUES(?, ?)';
		
		global $mysqli;
	  
	 	$stmt = $mysqli->prepare($query);
	 	$stmt->bind_param('ss', $description, $title);


	 	$getquery = 'SELECT  EventID as eid, 
	                    ToDoID as tdid,
	                    Description as description,
	                    Title as title,
	                    Points as pts
	                    FROM Todo NATURAL JOIN Has WHERE ToDoID = ?';

	    insertTodo($stmt, $getquery, $hasquery, 'todo', $eid);

	}
?>