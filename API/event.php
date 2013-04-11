<?php

  include('dataManipulation.php');

  $eid = $_GET['eid'];
 
	$query = 'SELECT 	EventID AS eid, 
  						Admin AS admin_fbid, 
  						Title AS title
  						FROM Event WHERE EventID = '. $eid.';';  

  jsonify($query, 'event');

?>