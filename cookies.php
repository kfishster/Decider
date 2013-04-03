<?php

  $hash_sha512 = '$99linesofphponthewall99linesofphp$';

  function hash_for_password($password){
    return hash('sha256',$password);
  }

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

  function set_cookie($fbid){
    $token = get_token($fbid);
    setcookie("DeciderApp", $token, time()+3600,"/");
  }

  function validate_cookie(){
     if(!isset($_COOKIE['DeciderApp'])) return False;

     $cookie = $_COOKIE['DeciderApp'];

     $addr = $_SERVER['REMOTE_ADDR'];
     $hash = hash('sha256',$cookie . $addr);
    
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

  function logout($fbid) {
    setcookie("DeciderApp", "", time()+3600,"/");

    $query = "DELETE FROM Cookies WHERE FacebookId=\"{$fbid}\"";
    $result = mysql_query($query) or die(mysql_error());
  }

  function getUserFBId(){
     $cookie = $_COOKIE['DeciderApp'];

     $addr = $_SERVER['REMOTE_ADDR'];
     $hash = hash('sha256',$cookie . $addr);
    
     $query = "SELECT FacebookId FROM Cookies WHERE Cookie=\"{$hash}\"";
     $result = mysql_query($query) or die(mysql_error());
     $row = mysql_fetch_array($result, MYSQL_NUM);
     return $row[0];
  }




?>