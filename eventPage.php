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


if(!isset($rows)) echo '<p>There are no ideas for this event yet, be the first to propose something!</p>';

echo '<div class="accordion" id="accordion2">';

foreach($rows as $todo)
{
	$hash = hash('md4', $todo['Title'] + strval(rand()));
	echo '<div class="accordion-group"> <div class="accordion-heading">';
	echo '<h4><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#'.$hash.'">'.$todo['Title'].'  |   '.$todo['Points'].' points</a></h4>';
	echo '</div>';
	
	echo '<div id="'.$hash.'" class="accordion-body collapse"><div class="accordion-inner">';
	echo '<p>'.$todo['Description'].'</p>';
	echo '</div></div></div>';

}
echo '</div>';

echo '<br><b><p>Event added by '.$event['Name'].'</p></b><br>';
echo '<br><p>Participants: ';

$query = 'SELECT Name FROM Event NATURAL JOIN Participates NATURAL JOIN User WHERE Event.EventID = ' . $id;
$result = mysql_query($query) or die(mysql_error());

for($i = 0; $row = @mysql_fetch_assoc($result); $i++) {
  $rows[$i] = $row;
}

$last = end($rows);
foreach($rows as $person)
{
	
	if($last == $person)
		echo $person['Name'];
	else
		echo $person['Name'] . ', ';
}
echo '</p><br>';



echo '<a id="newIdea" class="btn btn-info"><b>Add an idea</b></a><br>';

echo '<br><p>To add other people to this event, throw them this link:<br>';
echo 'http://decider.azurewebsites.net/joinEvent.php?id=' . $id;
echo '</p>';



?>



