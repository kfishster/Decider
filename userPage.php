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


$id = $_POST['id'];
$email = $_POST['email'];
$name = $_POST['name'];
$nameArray = explode(' ', $name);

echo $nameArray[0].'!';
?>
</h1>

<div class="container-fluid">
  <div class="row-fluid">
    <div class="span4">
      <ul class="nav nav-list">
        <li class="nav-header">My Events</li>

<?php

  include('./scripts/database_connection.php');
  global $id, $email, $name;

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
  else
  {
    $query = 'SELECT * FROM Event NATURAL JOIN User NATURAL JOIN Participates WHERE FBid = ' . $id;

      
    $result = mysql_query($query) or die(mysql_error());


    // Put the result in our own rows table.
    for($i = 0; $row = @mysql_fetch_assoc($result); $i++) {
      $rows[$i] = $row;
    }

    foreach ($rows as $event) {
      echo '<li><a href="#">'.$event['Title'].'</a></li>';
    }
  }

?>

      </ul>
    </div>
    <div class="span8">
      <!--Body content-->
    </div>
  </div>
</div>
</div>
</div>

</body>
</html>