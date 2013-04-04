<?php

  include('database_connection.php');


  $title = $_POST['title'];
  $descr = $_POST['descr'];
  $evID = $_POST['id'];
//todoID, points, Description, title

  $query = 'INSERT INTO Todo VALUES(NULL,0, "'.$descr.'", "'.$title.'");';

  $result = mysql_query($query) or die(mysql_error());

  $query = 'SELECT TodoID FROM Todo WHERE Title = "'.$title.'" AND Description = "'.$descr.'";';  

  $result = mysql_query($query) or die(mysql_error());  

  $rows =  mysql_fetch_assoc($result);

  $query = 'INSERT INTO Has VALUES('.$evID.', '.$rows['TodoID'].')';
  
  $result = mysql_query($query) or die(mysql_error());   

?>