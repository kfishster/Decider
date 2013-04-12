<?php

/*

database_connection.php

Connects to the Decider database, uses set credentials.

*/


$dbhost = "us-cdbr-azure-east-b.cloudapp.net";
$dbuser = "b1700f50bf2ed7";
$dbpass = "5d8622ae";
$dbname = "deciderAE9zUqb8x";

 $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

  if(mysqli_connect_errno()) {
      echo "Connection Failed: " . mysqli_connect_errno();
      exit();
   }
   echo 'Connected!';

?>