<!--
joinEvent.php

AJAX PHP endpoint. Adds current user to the event participants. If validate user successful, sends user
to the userpage with a successful join message. Else, sends to the index page with an error message.
-->

<?php


  include('scripts/database_connection.php');
  include('scripts/cookies.php');

  if(validate_cookie()) 
  {
    
    $id =  getUserFBId();
    $event = $_GET['id'];

    $query = 'INSERT INTO Participates VALUES('.$id.', '.$event.')';
    $result = mysql_query($query) or die(mysql_error());

    header( 'Location: /userPage.php?join=1' ) ;
  }
  else
  {
    
    header( 'Location: /index.php?error=1' ) ;
  }



?>