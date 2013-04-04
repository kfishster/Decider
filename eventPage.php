<?php


$id = $_POST['id'];

include('./scripts/database_connection.php');

$query = 'SELECT * FROM Has NATURAL JOIN Todo WHERE EventID = ' . $id;
$eventQuery = 'SELECT * FROM Event INNER JOIN User ON Admin = FBid WHERE EventID = ' . $id;

      
$result = mysql_query($query) or die(mysql_error());

for($i = 0; $row = @mysql_fetch_assoc($result); $i++) {
  $rows[$i] = $row;
}

$result = mysql_query($eventQuery) or die(mysql_error());

$event = mysql_fetch_assoc($result);

echo '<h3>'.$event['Title'].'</h3><br>';

foreach($rows as $todo)
{
	echo '<h4>'.$todo['Title'].'</h4>';
	echo '<p>'.$todo['Description'].'</p><br>';
}
echo '<a id="newIdea" class="btn btn-info"><b>Add an idea</b></a>';

echo '<br><p>Added by '.$event['Name'].'</p>'

?>

