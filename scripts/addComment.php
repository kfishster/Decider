<?php

  include('database_connection.php');


  $content = $_POST['content'];
  $author_fbid = $_POST['fbid'];
  $tdid = $_POST['tdid'];
  
  $curTime = time();
  //Inserts todo into the database
  $query = 'INSERT INTO Comments VALUES("'.$content.'",'.$author_fbid.', FROM_UNIXTIME('.$curTime.'), NULL);';
  echo $query;
  $result = mysql_query($query) or die(mysql_error());
  $cid = mysql_insert_id();
 
  //Attaches the todo to the event via a Has relation entry
  $query = 'INSERT INTO CommentedOn VALUES('.$cid.', '.strval($tdid).')';
  echo $query;
  $result = mysql_query($query) or die(mysql_error());   

?>