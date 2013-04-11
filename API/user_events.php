<?php

  include('database_connection.php');

  $fbid = $_GET['fbid'];

  $query = 'SELECT 	EventID AS eid, 
  					Admin AS admin_fbid, 
  					Title as title 
  					FROM Event NATURAL JOIN User NATURAL JOIN Participates WHERE FBid = ' . $id.'";';  

  $result = mysql_query($query) or die(mysql_error());

  for($i = 0; $row = @mysql_fetch_assoc($result); $i++) {
      $rows[$i] = $row;
  }

  $output['error_code'] = 0; 
  $output['result'] = $rows;
  
  echo json_encode($output);

?>