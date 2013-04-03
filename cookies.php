<?php
  /**
    * Manual Test Plan
    * 
    * Login with facebook
    * Refresh the page - if still logged in everything is cool
    * Click logout
    * Refresh the user page - if you are not logged in then things worked fine
    *
    * Login with Facebook
    * Copy the cookie from the browser
    * Go to a different computer, paste the cookie, and refresh the user page
    * Be denied and everything is cool
  **/

  //A hash value - Just for fun, not really relevant at all - Indicative of how much I like php
  $hash_sha512 = '$99linesofphponthewall99linesofphp$';

  //This function returns the hash for the cookie with the client address included
  //@return The hash for the cookie and client address
  function get_hash_for_cookie() {
    $cookie = $_COOKIE['DeciderApp'];
    $addr = $_SERVER['REMOTE_ADDR'];
    return hash('sha256',$cookie . $addr);
  }

  //This function creates a cookie token and adds it to the database
  //@param The facebook id of the user to create the token for
  //@return  The token that should be set as the cookie
  function get_token($fbid){
     $addr = $_SERVER['REMOTE_ADDR'];
    
     $length = 25;
     $token = uniqid();
     $hash = hash('sha256',$token);
    
     $db_hash = hash('sha256',$hash . $addr);
     $time = date('Y-m-d',strtotime('+1 week'));
     $query = "INSERT INTO Cookies VALUES(\"{$db_hash}\", \"{$fbid}\",\"{$time}\")";
     $result = mysql_query($query) or die(mysql_error());
    
    return $hash;
  }

  //This function sets a cookie for a facebook id in the users browser
  //@param The facebook id of the user to set the cookie for
  function set_cookie($fbid){
    $token = get_token($fbid);
    setcookie("DeciderApp", $token, time()+3600,"/");
  }

  //This function checks if the cookie is valid
  //@return A boolean variable which indicates whether the cookie is valid or not
  function validate_cookie(){
     if(!isset($_COOKIE['DeciderApp'])) return False;
     $hash = get_hash_for_cookie();
    
     $query = "SELECT FacebookId,Time FROM Cookies WHERE Cookie=\"{$hash}\"";
     $result = mysql_query($query) or die(mysql_error());
     $row = mysql_fetch_array($result, MYSQL_NUM);
    
     $fbid = $row[0];
     $exp_date = $row[1];
     $todays_date = date("Y-m-d");

     $today = strtotime($todays_date);
     $expiration_date = strtotime($exp_date);

     if ($expiration_date > $today) return True;
    
     logout($fbid);
    
    return False;
    
  }

  //This function logs a user out and deletes a cookie from the database
  //@param The Facebook Id of the user to logout 
  function logout($fbid) {
    setcookie("DeciderApp", "", time()+3600,"/");

    $query = "DELETE FROM Cookies WHERE FacebookId=\"{$fbid}\"";
    $result = mysql_query($query) or die(mysql_error());
  }

  //This function gets the user Facebook Id from the database given a cookie
  //@return The facebook id of the user whose token is in the cookie
  function getUserFBId(){
     $hash = get_hash_for_cookie();
    
     $query = "SELECT FacebookId FROM Cookies WHERE Cookie=\"{$hash}\"";
     $result = mysql_query($query) or die(mysql_error());
     $row = mysql_fetch_array($result, MYSQL_NUM);
     return $row[0];
  }

?>