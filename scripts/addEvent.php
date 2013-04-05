<!--
addEvent.php

Adds the event to the database and returns its eventID

-->

<?php

  include('database_connection.php');


  $title = $_POST['title'];
  $userID = $_POST['userID'];

  //Inserts event into the database
  $query = 'INSERT INTO Event VALUES(NULL, '.$userID.', "'.$title.'", NULL)';  


  $result = mysql_query($query) or die(mysql_error());

  //Retrieves the event to display the ID
  $query = 'SELECT EventID FROM Event WHERE Admin = '.$userID.' AND Title = "'.$title.'";';  

  $result = mysql_query($query) or die(mysql_error());  

    for($i = 0; $row = @mysql_fetch_assoc($result); $i++) {
      $rows[$i] = $row;
    }

  //Ties the user with the event via the Participates relation
  $query = 'INSERT INTO Participates VALUES('.$userID.', '.$rows[0]['EventID'].')';
  
  $result = mysql_query($query) or die(mysql_error());   

  //Return the eventID of this event
  echo $rows[0]['EventID'];

?>