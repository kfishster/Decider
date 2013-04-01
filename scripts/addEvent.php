<?php

  include('database_connection.php');


  $title = $_POST['title'];
  $userID = $_POST['userID'];

  echo $query;
  
  $query = 'INSERT INTO Event VALUES(NULL, '.$id.', "'.$title.'", NULL)';  
  $result = mysql_query($query) or die(mysql_error());

  $query = 'SELECT EventID FROM Event WHERE Admin = '.$id.' AND Title = "'.$title.'";';  
  $result = mysql_query($query) or die(mysql_error());  

    for($i = 0; $row = @mysql_fetch_assoc($result); $i++) {
      $rows[$i] = $row;
    }

  $query = 'INSERT INTO Participates VALUES('.$id.', '.$rows[0]['EventID'].')';
  $result = mysql_query($query) or die(mysql_error());   

  echo $rows[0]['EventID'];

?>