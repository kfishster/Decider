
<?php


$tdid = $_GET['tdid'];

include('database_connection.php');

//Retreives all the ToDos of the event
$query = 'SELECT * FROM CommentedOn NATURAL JOIN Comments INNER JOIN User ON author_fbid = FBid WHERE TodoID = '.$tdid.' ORDER BY date_submitted';

      
$result = mysql_query($query) or die(mysql_error());

for($i = 0; $row = @mysql_fetch_assoc($result); $i++) {
  $rows[$i] = $row;
}


echo '<h4>Comments</h4><br>';




if(!isset($rows)) echo '<p>There are no comments here yet, be the first to say something!</p>';

//Accordion collapsible list of ToDos

foreach($rows as $todo)
{
	
	echo '<blockquote>';
	echo '<p>'.$todo["content"].'</p>';
	echo '<small>'.$todo["Name"].'</small>';
	echo '</blockquote>';
	

}


echo '<br><h4>Add a comment</h4>';
echo '<input type="text" id="content" /><button type="submit" class="btn">Submit</button>'


?>



