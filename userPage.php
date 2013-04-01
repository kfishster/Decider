<!DOCTYPE html>
<html lang="en">
<head>
	<script src="bootstrap/js/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>
<title>Oh hai</title>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>


<div class="container">
  <h1>Hey, 
<?php

include('./scripts/database_connection.php');

$id = $_POST['id'];
$email = $_POST['email'];
$name = $_POST['name'];
$nameArray = explode(' ', $name);

echo $id, $email, $name;

echo $nameArray[0].'</h1><p>';

$query = 'SELECT * FROM Event NATURAL JOIN User NATURAL JOIN Participates WHERE FBid = ' . $id;

      
  $result = mysql_query($query) or die(mysql_error());

  // Put the result in our own rows table.
  for($i = 0; $row = @mysql_fetch_assoc($result); $i++) {
    $rows[$i] = $row;
  }

  if(!isset($rows))
  {
    //Put into database
    $query = 'INSERT INTO User VALUES('.$id.', "'.$email.'" , "'.$name.'");';
    $result = mysql_query($query) or die(mysql_error());
  }
  else
  {
    foreach ($rows as $event) {
      echo '<li>'.$event['Title'].'</li>';
    }
  }



?>
</p>
</div>

</body>
</html>