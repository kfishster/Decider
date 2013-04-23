<!--
addTodo.php

Adds a todo attached to an event to the database

-->

<?php

  include('database_connection.php');


  $title = $_POST['title'];
  $descr = $_POST['descr'];
  $evID = $_POST['id'];
  
  $locTitle = $_POST['locTitle'];
  $streetAddr = $_POST['streetAddr'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $lat = $_POST['lat'];
  $lon = $_POST['lon'];
 
  //Inserts todo into the database
  $query = 'INSERT INTO Todo VALUES(NULL,0, "'.$descr.'", "'.$title.'");';

  $result = mysql_query($query) or die(mysql_error());

  //Retreives the todoID which was generated from autoincrement
  $curTodo = mysql_insert_id();

  //Attaches the todo to the event via a Has relation entry
  $query = 'INSERT INTO Has VALUES('.$evID.', '.$curTodo.')';
  
  $result = mysql_query($query) or die(mysql_error());   

  if(strcmp($streetAddr,'') != 0)
  {
    $query = 'INSERT INTO Location VALUES(NULL, "'.$locTitle.'","'.$streetAddr.'", "'.$city.'", "'.$state.'", '.$lat.', '.$lon.')';
    
    $result = mysql_query($query) or die(mysql_error());   

    $curLoc = mysql_insert_id();

    $query = 'INSERT INTO islocated VALUES('.$curTodo.', '.$curLoc.')';
    
    $result = mysql_query($query) or die(mysql_error());  
  }

?>