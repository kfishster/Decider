<?php

include('database_connection.php');

function jsonify($query, $vars, $name){

  $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if(mysqli_connect_errno()) {
      echo "Connection Failed: " . mysqli_connect_errno();
      exit();
   }


  $stmt = $mysqli->prepare($query);

  $inp = '';
  for($i=0; $i < $vars.len(); $i++)
    $inp += 's';

  echo $inp;

  $stmt->bind_param($inp, $filehash);
  $stmt->execute();

  /* bind result variables */
  $stmt->bind_result($result);
  $count = 0;
  while ($stmt->fetch()) {

        $results[$count] = $result;
        $count++;
  }

  if(!isset($rows)) $error = 101;
  $output = array();

  $output['error_code'] = $error; 
  $output['result'] = array();
  $output['result'][$name] = $rows;

  echo json_encode($output);

}

function insert($query){

  $result = mysql_query($query) or die(mysql_error());

}

function insert_and_echo($insert, $get, $name){

  insert($insert);
  jsonify($get, $name);

}

function prepareExec($template, $vars)
{
  $stmt = $mysqli->prepare($template);

  $inp = '';
  for($i=0; $i < $vars.len(); $i++)
    $inp += 's';

  $stmt->bind_param($inp, $filehash);
  $stmt->execute();

  /* bind result variables */
  $stmt->bind_result($result);
}

?>