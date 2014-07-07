<?php

// Include Database Class

include 'db.php';

// Start Database Object
$db = new DB();

// Write SQL Statement
$sql = "SELECT * FROM weatherlog ORDER BY weatherlog_id DESC LIMIT 1";

// echo $results;
// Execute SQL Statement
$results = $db->execute($sql);

if ($results->num_rows != 0) {

 
    // search through the database and pull the matching results
    while ($row = $results->fetch_assoc()) {

        $response = $row;

    }
   
    header('Content-type: application/json');

    echo json_encode($response);
    
} else {

    http_response_code(400); 
}

?>