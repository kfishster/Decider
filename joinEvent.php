<?php


  include('database_connection.php');
  include('cookies.php');

  if(validate_cookie()) 
  {
    
    $id =  getUserFBId();
    $event = $_GET['id'];

    $query = 'INSERT INTO Participates VALUES('.$id.', '.$event.')';
    $result = mysql_query($query) or die(mysql_error());

    echo 'Added!';
    //header( 'Location: /userPage.php?join=1' ) ;
  }
  else
  {
    echo 'else!';
    //header( 'Location: /index.php?error=1' ) ;
  }



?>