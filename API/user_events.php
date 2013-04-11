<?php

  include('dataManipulation.php');

  $fbid = $_GET['fbid'];

  $query = 'SELECT 	EventID AS eid, 
  					Admin AS admin_fbid, 
  					Title as title 
  					FROM Event NATURAL JOIN User NATURAL JOIN Participates WHERE FBid = '. $fbid.';';  

  jsonify($query);

?>