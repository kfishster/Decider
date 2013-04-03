<!DOCTYPE html>
<html lang="en">
<head>
	<script src="bootstrap/js/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>
<title>Decidr</title>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>




<div class="container">
  <h1 style="text-align: center;">Hey, 
<?php
  include('./cookies.php');

$id = $_POST['id'];
$email = $_POST['email'];
$name = $_POST['name'];
$nameArray = explode(' ', $name);

  set_cookie($id);

echo $nameArray[0].'!';
?>
</h1>
<br>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span4">
      <div class="well">
      <ul class="nav nav-list" id="eventList">
        <li class="nav-header" id="getUserID" userID="<?php global $id; echo $id;?>">My Events</li>

<?php

  include('./scripts/database_connection.php');
  include('./cookies.php');
  global $id, $email, $name;

  if(validate_cookie()) echo "done";
  else echo "not logged in";

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
      echo '<li><a class="openEvent" eventID="'.$event['EventID'].'">'.$event['Title'].'</a></li>';
    }
  }

?>
    </ul>
    <ul class="nav nav-list">
    <li class="nav-header"></li>
    <li><a id="newEvent"><b>+ Create a new event</b></a></li>
      </ul>
    </div>
  </div>
    <div class="span8" id="eventContent">
      <h4>Click on an event on the left sidebar to see what all the fuss is about.</h4><br><br><p>Remember that thing that you wanted to go to? Yea, that one. Well, you still haven't decided what you're
      going to be doing. Maybe you should make a new event for that and invite all your friends!</p>
    </div>
  </div>
</div>
</div>
</div>

<script type="text/javascript">

$('#newEvent').click(function(){

  $('#eventContent').fadeOut("slow", function(){

      $(this).load('newEventForm.php', function(){

        $(this).fadeIn("slow");
    });

  });
  

});

$('.openEvent').click(function(){

  id = $(this).attr('eventID');
  $('#eventContent').fadeOut("slow", function(){

      $(this).load('eventPage.php',{id:id} ,function(){

        $(this).fadeIn("slow");
    });

  });

});




</script>

</body>
</html>


