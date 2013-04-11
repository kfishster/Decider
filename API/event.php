<?php

  include('dataManipulation.php');

  $eid = $_GET['eid'];
 
	$query = 'SELECT 	EventID AS eid, 
  						Admin AS admin_fbid, 
  						Title AS title,
  						Description AS description 
  						FROM Event NATURAL JOIN User NATURAL JOIN Participates WHERE EventID = '. $eid.';';  

  jsonify($query, 'event');

?>