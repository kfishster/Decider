<?php


  include('database_connection.php');
  include('cookies.php');

  if(validate_cookie()) 
  {
    
    $id =  getUserFBId();
    //echo $id;    
    logout($id);
    header( 'Location: ../index.php' ) ;
  }
  else
  {
    
    header( 'Location: ../index.php' ) ;
  }



?>