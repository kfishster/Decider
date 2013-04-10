<!--
eventPage.php

Loads all the event's information including the title, description, date,
and the list of toDos that belong to it. Also prints the creator of the 
event and its participants.

-->

<?php


$id = $_POST['id'];

include('./scripts/database_connection.php');

//Retreives all the ToDos of the event
$query = 'SELECT * FROM Has NATURAL JOIN Todo WHERE EventID = ' . $id;
//Gets the admin of the event
$eventQuery = 'SELECT * FROM Event INNER JOIN User ON Admin = FBid WHERE EventID = ' . $id;

      
$result = mysql_query($query) or die(mysql_error());

for($i = 0; $row = @mysql_fetch_assoc($result); $i++) {
  $rows[$i] = $row;
}

$result = mysql_query($eventQuery) or die(mysql_error());

$event = mysql_fetch_assoc($result);

echo '<h3>'.$event['Title'].'</h3><br>';


if(!isset($rows)) echo '<p>There are no ideas for this event yet, be the first to propose something!</p>';

//Accordion collapsible list of ToDos
echo '<div class="accordion" id="accordion2">';

foreach($rows as $todo)
{
	$hash = hash('md4', $todo['Title'] + strval(rand()));
	echo '<div class="accordion-group"> <div class="accordion-heading">';
	echo '<h4><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#'.$hash.'">';
	echo '<div class"row-fluid"><div class="span10">';
	echo $todo['Title'].'</a></h4>';
	echo '</div>';
	echo '<div class="span2">'.$todo['Points'].' points</div>';
	echo '</div></div>';
	
	echo '<div id="'.$hash.'" class="accordion-body collapse"><div class="accordion-inner">';
	echo '<p>'.$todo['Description'].'</p>';
	echo '</div></div></div><br>';

}
echo '</div>';

echo '<br><b><p>Event added by '.$event['Name'].'</p></b><br>';
echo '<br><p>Participants: ';

//Gets all the participants of the event
$query = 'SELECT Name FROM Event NATURAL JOIN Participates NATURAL JOIN User WHERE Event.EventID = ' . $id;
$result = mysql_query($query) or die(mysql_error());

for($i = 0; $row = @mysql_fetch_assoc($result); $i++) {
  $rows[$i] = $row;
}

$last = count($rows);

$i = 0;

foreach($rows as $person)
{
	
	if(++$i === $last)
		echo $person['Name'].'<br><br>';
	else
		echo $person['Name'] . ', ';
}



echo '<a id="newIdea" class="btn btn-info"><b>Add an idea</b></a><br>';

//Join link
echo '<br><p>To add other people to this event, throw them this link:<br>';
echo 'http://decider.azurewebsites.net/joinEvent.php?id=' . $id;
echo '</p>';



?>



