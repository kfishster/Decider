<?php

/*

addPoint.php

If point on this todo from the user was already submitted, then change the existing entry
else, put it in the table.

*/


  include('database_connection.php');


  $todo = $_POST['todo'];
  $userID = $_POST['userID'];
  $point = intval($_POST['point']);

  //Retrieves the event to display the ID
  $query = 'SELECT * FROM Points WHERE FBid = '.$userID.' AND TodoID = "'.$todo.'";';  

  $result = mysql_query($query) or die(mysql_error());
  $rows =  mysql_fetch_assoc($result);

  if($rows)
  {
    if(intval($rows['Point']) == $point)
      echo 0;
    else
    {
      $query = 'UPDATE Points SET Point='.$point.' WHERE ToDoID='.$todo.';';
      
      $result = mysql_query($query) or die(mysql_error());


      $query = 'UPDATE Todo SET Points= Points + '.$point.' WHERE ToDoID='.$todo.';';   

      $result = mysql_query($query) or die(mysql_error());

      echo $point;
    }
  }
  else
  {
    $query = 'INSERT INTO Points VALUES('.$todo.', '.$userID.', '.$point.'); ';
    $result = mysql_query($query) or die(mysql_error());
    
    $query = 'UPDATE Todo SET Points= Points + '.$point.' WHERE ToDoID='.$todo.';';

    $result = mysql_query($query) or die(mysql_error());

    echo $point;
  }
  

?>