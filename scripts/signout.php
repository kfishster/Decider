<!--
signout.php

Signs out the user redirects to the index

-->

<?php


  include('database_connection.php');
  include('cookies.php');

  //If user is logged in, log him out and redirect, else, just redirect
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