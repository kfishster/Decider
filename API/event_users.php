<?php

  include('dataManipulation.php');

  $eid = $_GET['eid'];
 
  $query = 'SELECT  FBid as fbid, 
                    Email as email,
                    Name as name
                    FROM Event NATURAL JOIN Participates NATURAL JOIN User WHERE Event.EventID = ' . $id;

  jsonify($query, 'users');

?>