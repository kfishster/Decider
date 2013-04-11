function FBLogin()
{

  /* FACEBOOK LOGIN API START */

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

            //If login successful, register user and set cookie via signin php endpoint, then redirect to userPage
            $.post('./scripts/signin.php', {id: ID, email:email, name:name}, function(response){window.location = 'userPage.php';});
        	

        	}, { perms: 'email' });
           	
        } else {
            // cancelled TODO show error
        }
    }, {scope: 'email'});
	}

  /* FACEBOOK LOGIN API END */

  //Attaches click functionality to login through fb button
	$(document).ready(function(){
		$('#loginFB').click(function(){ 
			login();  
		});
	});
}
