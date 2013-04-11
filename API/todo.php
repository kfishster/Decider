<?php

  include('dataManipulation.php');

  $tdid = $_GET['tdid'];
 
  $query = 'SELECT  EventID as eid, 
                    ToDoID as tdid,
                    Description as description,
                    Title as title,
                    Points as pts
                    FROM Todo NATURAL JOIN Has WHERE ToDoID = ' . $tdid;

  jsonify($query, 'todo');

?>