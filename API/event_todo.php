<?php

 	include('dataManipulation.php');

  	$eid = $_GET['eid'];
 
  	$query = 'SELECT  EventID as eid, 
                    ToDoID as tdid,
                    Title as title,
                    Points as pts
                    FROM Has NATURAL JOIN Todo WHERE EventID = ? ORDER BY Points DESC;';


  	global $mysqli;
  
 	$stmt = $mysqli->prepare($query);
 	$stmt->bind_param('s', $eid);

    jsonify($stmt, 'todo');

?>