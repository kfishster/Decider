<?php

  include('dataManipulation.php');

  if(isset($_GET['eid']))
  {
	  	$eid = $_GET['eid'];
	 
	  	$query = 'SELECT 	EventID AS eid, 
	  						Admin AS admin_fbid, 
	  						Title AS title
	  						FROM Event WHERE EventID = ?;';  

	  	jsonify($query, [$eid], 'event');

  }
  else if(isset($_POST['adminfbid']))
  {

   	$adminfbid = $_POST['adminfbid'];
   	$title = $_POST['title'];
   	$description = $_POST['description']; 
  
  	$insert = 'INSERT INTO Event VALUES(NULL, '.$userID.', "'.$title.'", NULL, '.$description.')';

  	insert($insert);
  }

?>