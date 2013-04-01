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

<body>

    <div class="container">

      
     

      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Join your friends' events!</h1>
        <p class="lead">Login to Decidr with Facebook to coordinate your hang outs and meet ups!</p>
        <a class="btn btn-large btn-success" id="loginFB">Login with Facebook</a>
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
        		
        		$('#inset_form').html('<form action="./userPage.php" name="send" method="post" style="display:none;"><input type="text" name="id" value="' + ID + '" /><input type="text" name="email" value="' + email + '" /><input type="text" name="name" value="' + name + '" /></form>');
    			document.forms['send'].submit();

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