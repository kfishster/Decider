<!--
signin.php

Sets the cookie for the user and inserts them into the database if they haven't
been inserted already.

-->

<?php

  include('database_connection.php');
  include('cookies.php');


  $id = $_POST['id'];
  $email = $_POST['email'];
  $name = $_POST['name'];

  //Sets the cookie for the user (see cookies.php for details)
  set_cookie($id);

  //Finds the user by fb id
  $query = 'SELECT * FROM User WHERE FBid = ' . $id;
    
  $result = mysql_query($query) or die(mysql_error());

  for($i = 0; $row = @mysql_fetch_assoc($result); $i++) {
    $rows[$i] = $row;
  }

  if(is_null($rows))
  {
    //If user does not exist, add them to the database
    $query = 'INSERT INTO User VALUES('.$id.', "'.$email.'" , "'.$name.'");';
    $result = mysql_query($query) or die(mysql_error());
  
  }

?>