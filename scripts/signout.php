<?php

     echo "found";
  include('database_connection.php');
  include('cookies.php');

  if(validate_cookie()) 
  {
         echo "in if";
     // logout(getUserFBId());
      //header('Location: ~/index.php')
  }
  else
  {
     echo "in else";
    //header('Location: ~/index.php');
  }



?>