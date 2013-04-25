<?php

  	include('dataManipulation.php');

    if(isset($_GET['tdid']))
	{

	  	$tdid = $_GET['tdid'];
 
	  	$checkLoc = 'SELECT * FROM isLocated WHERE TodoID = ?';
	  	$stmt = $mysqli->prepare($checkLoc);
	 	$stmt->bind_param('s', $tdid);

	 	$stmt->execute();

	 	$result = $stmt->get_result();

	 	$row = $result->fetch_assoc();
	 	
	 	if(isset($row))
	 	{
	 		$query = 'SELECT  EventID as eid, 
	                    ToDoID as tdid,
	                    Description as description,
	                    Todo.Title as title,
	                    Points as pts,
						Latitude as lat,
						Longitude as lon,
						Street_Address as address,
						City as city,
						State as state,
						Location.Title as location_title
	                    FROM Todo NATURAL JOIN Has 
						NATURAL JOIN isLocated 
						INNER JOIN Location ON 
						Todo.TodoID = isLocated.TodoID AND Location.LocationID = isLocated.LocationID 
						WHERE ToDoID = ?';
	 	}
	 	else
	 	{
	 		$query = 'SELECT  EventID as eid, 
	                    ToDoID as tdid,
	                    Description as description,
	                    Title as title,
	                    Points as pts
	                    FROM Todo NATURAL JOIN Has WHERE ToDoID = ?';

	 	}

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