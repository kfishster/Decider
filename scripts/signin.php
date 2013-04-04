<?php

  include('database_connection.php');
  include('./cookies.php');


  $id = $_POST['id'];
  $email = $_POST['email'];
  $name = $_POST['name'];

  set_cookie($id);

  $query = 'SELECT * FROM User WHERE FBid = ' . $id;
    
  $result = mysql_query($query) or die(mysql_error());

  for($i = 0; $row = @mysql_fetch_assoc($result); $i++) {
    $rows[$i] = $row;
  }

  if(is_null($rows))
  {
    //Put into database
    $query = 'INSERT INTO User VALUES('.$id.', "'.$email.'" , "'.$name.'");';
    $result = mysql_query($query) or die(mysql_error());
  
  }

?>