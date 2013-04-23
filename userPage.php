<!--
userPage.php

Second main page. Displays all events that this person is participating in on the left sidebar
and asynchronously loads the event page on the right side.

-->

<?php

  include('./scripts/database_connection.php');
  include('./scripts/cookies.php');

  //If cookies not calidated, throws person back to index.php
  if(!validate_cookie()) header('Location: index.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<script src="bootstrap/js/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>
<title>DecidR</title>
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
      font-size: 36px;
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
        <li><a href="./scripts/signout.php">Logout <?php 


        $name  = explode(' ', getUserName());
        echo $name[0]; 

        ?></a></li>
      </ul>
    </div>
  </div>
</div>



<div class="container">

<?php

      //Successful alert that shows up when join is successful
      if(isset($_GET['join']))
        echo '<div class="alert alert-success"><b>Successfully joined the event!</b> Check it out in the sidebar.</div>';
?>

<div class="container-fluid">
  <div class="row-fluid">
    <div class="span4">
      <div class ="hero-unit">
        <div class="well">
          <ul class="nav nav-list" id="eventList">
            <li class="nav-header" id="getUserID" userID="<?php echo getUserFBId();?>">My Events</li>

<?php


  $id = getUserFBId();

  //Get user information from database
  $query = 'SELECT * FROM User WHERE FBid = ' . $id;

      
  $result = mysql_query($query) or die(mysql_error());

    for($i = 0; $row = @mysql_fetch_assoc($result); $i++) {
      $rows[$i] = $row;
    }


    //Get all events the person is participating in
    $query = 'SELECT * FROM Event NATURAL JOIN User NATURAL JOIN Participates WHERE FBid = ' . $id;

      
    $result = mysql_query($query) or die(mysql_error());


    // Put the result in our own rows table.
    for($i = 0; $row = @mysql_fetch_assoc($result); $i++) {
      $rows[$i] = $row;
    }

    //Prints all events as bullets on the left sidebar
    foreach ($rows as $event) {
      echo '<li><a class="openEvent" href="#" eventID="'.$event['EventID'].'">'.$event['Title'].'</a></li>';
    }
  

?>
          </ul>
          <ul class="nav nav-list">
            <li class="nav-header"></li>
            <li><a id="newEvent"><b>+ Create a new event</b></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="span8" id="eventContent">
      <div class ="hero-unit">
        <h4>Click on an event on the left sidebar to see what all the fuss is about.</h4><br><br><p>Remember that thing that you wanted to go to? Yea, that one. Well, you still haven't decided what you're
        going to be doing. Maybe you should make a new event for that and invite all your friends!</p>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<script src="pageScripts.js"></script>
<script type="text/javascript">userPageScripts();</script>

<div id="createEventModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h3 id="myModalLabel">New Event</h3>
    </div>
    <div class="modal-body">
      <div class="tab-pane">
          <div>
              <form id="submitEvent" class="form" method="post">
        
                  <div class="controls">
                  <input type="text" id="titleinp" placeholder="Title" class="span5">
                  </div>
                  <div class="controls controls-row">
                   <input type="text" id="dateinp" placeholder="Date" class="span3">
                    <input type="text" id="timeinp" placeholder="Time" class="span2">
                  </div>
    
                  <button type="submit" class="btn">Submit</button>
                    <br>
                     <div class="progress progress-striped active" style="display:none;" id="eventLoading">
                        <div class="bar" style="width: 10%;"></div>
                    </div>
                  </form>
                 
                 </div>
          </div>
    </div>
    
  </div>

  <div id="createTodoModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h3 id="myModalLabel">New Idea</h3>
    </div>
    <div class="modal-body">
      <div class="tab-pane">
        <div>
          <form id="submitTodo" eventID="" class="form" method="post">

            <div class="controls">
              <input type="text" required id="titletodo" placeholder="Title" class="span5">
            </div>
            <div class="controls controls-row">
             <textarea rows="3" required placeholder="Description" id="descr" class="span5"></textarea>
           </div>
           <div class="controls">
              <input type="text" id="location" placeholder="Location eg. 1234 Fake St, Urbana, IL" class="span5">
            </div>

           <button id="todoSubmitConf" type="submit" class="btn" loc="0">Submit</button>
          

         </form>

       </div>
     </div>
   </div>

 </div>

</body>
</html>


