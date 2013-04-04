<?php

  include('./scripts/database_connection.php');
  include('./scripts/cookies.php');

  if(!validate_cookie()) header('Location: index.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<script src="bootstrap/js/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>
<title>Decidr</title>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <style type="text/css">
    /* CUSTOMIZE THE NAVBAR
    -------------------------------------------------- */

    /* Remove border and change up box shadow for more contrast */
    .navbar .navbar-inner {
      border: 0;
      -webkit-box-shadow: 0 2px 10px rgba(0,0,0,.25);
         -moz-box-shadow: 0 2px 10px rgba(0,0,0,.25);
              box-shadow: 0 2px 10px rgba(0,0,0,.25);
    }
    /* Downsize the brand/project name a bit */
    .navbar .brand {
      padding: 14px 20px 16px; /* Increase vertical padding to match navbar links */
      font-size: 16px;
      font-weight: bold;
      text-shadow: 0 -1px 0 rgba(0,0,0,.5);
    }

    /* Navbar links: increase padding for taller navbar */
    .navbar .nav > li > a {
      padding: 15px 20px;
    }

    /* Offset the responsive button for proper vertical alignment */
    .navbar .btn-navbar {
      margin-top: 10px;
    }

    </style>

</head>
<body>

<div class="navbar">
  <div class="navbar-inner">
    <a class="brand" href="index.php">DecidR</a>
    <div class="pull-right">
      <ul class="nav">
        <li><a href="#">Settings</a></li>
        <li><a href="./userPage.php">Events</a></li>
        <li><a href="./scripts/signout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</div>



<div class="container">
  <h1 style="text-align: center;">Hey, 
<?php

  $id = getUserFBId();

  $query = 'SELECT * FROM User WHERE FBid = ' . $id;

      
  $result = mysql_query($query) or die(mysql_error());

  for($i = 0; $row = @mysql_fetch_assoc($result); $i++) {
    $rows[$i] = $row;
  }


  $nameArray = explode(' ', $rows[0]['Name']);


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

  global $id;

  $query = 'SELECT * FROM User WHERE FBid = ' . $id;

      
  $result = mysql_query($query) or die(mysql_error());

    for($i = 0; $row = @mysql_fetch_assoc($result); $i++) {
      $rows[$i] = $row;
    }


    $query = 'SELECT * FROM Event NATURAL JOIN User NATURAL JOIN Participates WHERE FBid = ' . $id;

      
    $result = mysql_query($query) or die(mysql_error());


    // Put the result in our own rows table.
    for($i = 0; $row = @mysql_fetch_assoc($result); $i++) {
      $rows[$i] = $row;
    }

    foreach ($rows as $event) {
      echo '<li><a class="openEvent" eventID="'.$event['EventID'].'">'.$event['Title'].'</a></li>';
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


