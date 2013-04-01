<?php


$id = $_POST['id'];

include('./scripts/database_connection.php');

$query = 'SELECT * FROM Event INNER JOIN User ON Admin = FBid WHERE EventID = ' . $id;

      
$result = mysql_query($query) or die(mysql_error());

for($i = 0; $row = @mysql_fetch_assoc($result); $i++) {
  $rows[$i] = $row;
}

echo '<h3>'.$rows['Title'].'</h3>';
echo '<br><p>Added by '.$rows['Name'].'</p>'

?>

