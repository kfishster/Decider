<!DOCTYPE html>

<?php

  include('./scripts/database_connection.php');
  include('./scripts/cookies.php');


?>

<html lang="en">
<head>
	<script src="bootstrap/js/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>
<title>Decidr</title>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <style type="text/css">
      body {
        padding-bottom: 60px;
      }

      /* Custom container */
      .container {
        margin: 0 auto;
        max-width: 1000px;
      }
      .container > hr {
        margin: 60px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 80px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 100px;
        line-height: 1;
      }
      .jumbotron .lead {
        font-size: 24px;
        line-height: 1.25;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }


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

        <?php

         if(validate_cookie()) 
            {
              $name  = explode(' ', getUserName());
              
              echo '<li><a href="./userPage.php">Events</a></li>';
              echo '<li><a href="./scripts/signout.php">Logout '.$name[0].'</a></li>';
            }
         else
              echo '<li><a id="loginFB">Login with Facebook</a></li>';

        ?>
        
      </ul>
    </div>
  </div>
</div>

      
     <div class="container">

      <?php

      if(isset($_GET['error']))
        echo '<div class="alert alert-error"><b>You have to log in to join an event</b> Login is at the upper right section of the page!</div>';
      ?>
      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Join your friends' events!</h1>
        <p class="lead">Login to Decidr to coordinate your hang outs and meet ups!</p>
        
      </div>

      <hr>

      <!-- Example row of columns -->
      <div class="row-fluid">
        <div class="span4">
          <h2>iPhone</h2>
          <p>An iPhone app is going to be made in a little while!</p>
          <p><a class="btn" href="#">Marketplace link &raquo;</a></p>
        </div>
        <div class="span4">
          <h2>Android</h2>
          <p>An Android app is going to be made in a little while! </p>
          <p><a class="btn" href="#">Marketplace link &raquo;</a></p>
       </div>
        <div class="span4">
          <h2>Windows Phone 8</h2>
          <p>An Windows Phone app is going to be made in a little while!</p>
          <p><a class="btn" href="#">Marketplace link &raquo;</a></p>
        </div>
      </div>

      <hr>

      <div class="footer">
        <p>&copy; Very Good Company 2013</p>
      </div>

    </div> <!-- /container -->


<div id="fb-root"></div>
<div id="inset_form"></div>

<script>

  // Additional JS functions here
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '153783808115722', // App ID
      channelUrl : '//https://decider.azurewebsites.net//channel.html', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    // Additional init code here

  };

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));

  function login() {
    FB.login(function(response) {
        if (response.authResponse) {

        	var ID = 0;
        	FB.api('/me', function(response) {
        		ID = response.id;
        		email = response.email;
        		name = response.name;

            $.post('./scripts/signin.php', {id: ID, email:email, name:name}, function(response){window.location = 'userPage.php';});
        		
        		//$('#inset_form').html('<form action="./userPage.php" name="send" method="post" style="display:none;"><input type="text" name="id" value="' + ID + '" /><input type="text" name="email" value="' + email + '" /><input type="text" name="name" value="' + name + '" /></form>');
    			//document.forms['send'].submit();

        	}, { perms: 'email' });
           	
        } else {
            // cancelled
        }
    }, {scope: 'email'});
	}

	function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
        console.log('Good to see you, ' + response.id + '.');
    });
	}

	$(document).ready(function(){
		$('#loginFB').click(function(){ 
			login();  
		});
	});
</script>



</body>
</html>