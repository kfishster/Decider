<?php

  include('database_connection.php');
  include('cookies.php');

  if(validate_cookie()) 
  {
      logout(getUserFBId());
      header('Location: ~/index.php')
  }
  else
  {
    header('Location: ~/index.php');
  }



?>