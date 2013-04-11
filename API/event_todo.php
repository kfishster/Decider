<?php

  include('dataManipulation.php');

  $eid = $_GET['eid'];
 
  $query = 'SELECT  EventID as eid, 
                    ToDoID as tdid,
                    Title as title,
                    Points as pts,
                    FROM Has NATURAL JOIN Todo WHERE EventID = ' . $eid .' ORDER BY Points DESC';

  jsonify($query);

?>