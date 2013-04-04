<?php


  include('database_connection.php');
  include('cookies.php');

  if(validate_cookie()) 
  {
    
    $id =  getUserFBId();
    $event = $_GET['id'];

    $query = 'INSERT INTO Participates VALUES('.$id.', '.$event.')';
    $result = mysql_query($eventQuery) or die(mysql_error());

    header( 'Location: userPage.php?join=1' ) ;
  }
  else
  {
    
    header( 'Location: index.php?error=1' ) ;
  }



?>