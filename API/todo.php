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
	 
	 	
		$locationQuery = 'SELECT LocationID as lid,
						Latitude as lat,
						Longitude as lon,
						Street_Address as address,
						City as city,
						State as state,
						Title as title
						FROM isLocated Natural JOIN Location WHERE TodoID = ?';

		global $mysqli;

	 	$stmt = $mysqli->prepare($query);
	 	$stmt->bind_param('s', $tdid);

	    $stmt->execute();


		  /* bind result variables */
		  $result = $stmt->get_result();
		  
		  $row = $result->fetch_assoc();
		  $error = '100';
		  if(!isset($row)) $error = '101';
		  $output = array();

		  $output['error_code'] = $error; 
		  $output['result'] = array();
		  $output['result']['todo'] = $row;


		  $stmt = $mysqli->prepare($locationQuery);
	 		$stmt->bind_param('s', $tdid);

	    	$stmt->execute();


		  /* bind result variables */
		  $result = $stmt->get_result();
		  
		  $row = $result->fetch_assoc();
		  	 $output['result']['location'] = $row;

		  echo json_encode($output);
	  


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