<?php

  include('database_connection.php');


  $title = $_POST['title'];
  $userID = $_POST['userID'];


  $query = 'INSERT INTO Event VALUES(NULL, '.$userID.', "'.$title.'", NULL)';  


  $result = mysql_query($query) or die(mysql_error());

  $query = 'SELECT EventID FROM Event WHERE Admin = '.$userID.' AND Title = "'.$title.'";';  

  $result = mysql_query($query) or die(mysql_error());  

    for($i = 0; $row = @mysql_fetch_assoc($result); $i++) {
      $rows[$i] = $row;
    }

  $query = 'INSERT INTO Participates VALUES('.$userID.', '.$rows[0]['EventID'].'); INSERT INTO Makes VALUES('.$userID.', '.$rows[0]['EventID']');';
  
  
  $result = mysql_query($query) or die(mysql_error());   

  echo $rows[0]['EventID'];

?>