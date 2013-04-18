<?php

include('database_connection.php');

function jsonify($stmt, $name){

  $stmt->execute();


  /* bind result variables */
  $result = $stmt->get_result();
  $count = 0;
  $rows = null;
  while ($row = $result->fetch_assoc()) {
        $rows[$count] = $row;
        $count++;
    }

  $error = null;

  if(!isset($rows)) $error = 101;
  $output = array();

  $output['error_code'] = $error; 
  $output['result'] = array();
  $output['result'][$name] = $rows;

  echo json_encode($output);

}

function insert($stmt, $query, $name){

  global $mysqli;

  $stmt->execute();
  $eid = $mysqli->insert_id;

  $stmt = $mysqli->prepare($query);
  $stmt->bind_param('s', $eid);
  
  $stmt->execute();


  /* bind result variables */
  $result = $stmt->get_result();
  $count = 0;
  $rows = null;
  while ($row = $result->fetch_assoc()) {
        $rows[$count] = $row;
        $count++;
    }

  $error = null;

  if(!isset($rows)) $error = 101;
  $output = array();

  $output['error_code'] = $error; 
  $output['result'] = array();
  $output['result'][$name] = $rows;

  echo json_encode($output);

}

function runWithoutOutput($stmt){

  global $mysqli;

  $stmt->execute();
  $output = array();
  $error = null;
  $output['error_code'] = $error; 
  $output['result'] = array();

  echo json_encode($output);

}

function insertTodo($stmt, $getquery, $hasquery, $name, $eid){

  global $mysqli;

  $stmt->execute();
  $tdid = $mysqli->insert_id;


  $stmt = $mysqli->prepare($getquery);
  $stmt->bind_param('s', $tdid);
  
  $stmt->execute();

  $result = $stmt->get_result();

  $stmt = $mysqli->prepare($hasquery);
  $stmt->bind_param('ss', $eid, $tdid);
  
  $stmt->execute();


  /* bind result variables */
  
  $count = 0;
  $rows = null;
  while ($row = $result->fetch_assoc()) {
        $rows[$count] = $row;
        $count++;
    }

  $error = null;

  if(!isset($rows)) $error = 101;
  $output = array();

  $output['error_code'] = $error; 
  $output['result'] = array();
  $output['result'][$name] = $rows;

  echo json_encode($output);

}

function insertEvent($stmt, $getquery, $parquery, $name, $fbid){

  global $mysqli;

  $stmt->execute();
  $eid = $mysqli->insert_id;


  $stmt = $mysqli->prepare($getquery);
  $stmt->bind_param('s', $eid);
  
  $stmt->execute();

  $result = $stmt->get_result();

  $stmt = $mysqli->prepare($parquery);
  $stmt->bind_param('ss', $fbid, $eid);
  
  $stmt->execute();


  /* bind result variables */

  $count = 0;
  $rows = null;
  while ($row = $result->fetch_assoc()) {
        $rows[$count] = $row;
        $count++;
    }

  $error = null;

  if(!isset($rows)) $error = 101;
  $output = array();

  $output['error_code'] = $error; 
  $output['result'] = array();
  $output['result'][$name] = $rows;

  echo json_encode($output);

}

function exists($stmt){

  $stmt->execute();


  /* bind result variables */
  $result = $stmt->get_result();
  $count = 0;
  $rows = null;
  while ($row = $result->fetch_assoc()) {
        $rows[$count] = $row;
        $count++;
    }

  $error = null;

  if(!isset($rows)) return false;
  else return true;

}

?>