<?php

  include('dataManipulation.php');

  $fbid = $_GET['fbid'];
 
  $query = 'SELECT  FBid as fbid, 
                    Email as email,
                    Name as name
                    FROM User WHERE FBid = ' . $fbid;

  jsonify($query, 'user');

?>