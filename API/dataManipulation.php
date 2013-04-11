<?php

include('database_connection.php');

function jsonify($query, $name){

  $result = mysql_query($query) or die(mysql_error());

  for($i = 0; $row = @mysql_fetch_assoc($result); $i++) {
      $rows[$i] = $row;
  }

  if(!isset($rows)) $error = 101;
  $output = array();

  $output['error_code'] = $error; 
  $output['result'] = array();
  $output['result'][$name] = $rows;

  echo json_encode($output);

}

?>