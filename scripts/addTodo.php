<!--
addTodo.php

Adds a todo attached to an event to the database

-->

<?php

  include('database_connection.php');


  $title = $_POST['title'];
  $descr = $_POST['descr'];
  $evID = $_POST['id'];

  //Inserts todo into the database
  $query = 'INSERT INTO Todo VALUES(NULL,0, "'.$descr.'", "'.$title.'");';

  $result = mysql_query($query) or die(mysql_error());

  //Retreives the todoID which was generated from autoincrement
  $query = 'SELECT TodoID FROM Todo WHERE Title = "'.$title.'" AND Description = "'.$descr.'";';  

  $result = mysql_query($query) or die(mysql_error());  

  $rows =  mysql_fetch_assoc($result);

  //Attaches the todo to the event via a Has relation entry
  $query = 'INSERT INTO Has VALUES('.$evID.', '.$rows['TodoID'].')';
  
  $result = mysql_query($query) or die(mysql_error());   

?>