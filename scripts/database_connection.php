<?php

/*

database_connection.php

Connects to the Decider database, uses set credentials.

*/


$dbhost = "us-cdbr-azure-east-b.cloudapp.net";
$dbuser = "b1700f50bf2ed7";
$dbpass = "5d8622ae";
$dbname = "deciderAE9zUqb8x";

mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());

mysql_select_db($dbname) or die(mysql_error());

?>