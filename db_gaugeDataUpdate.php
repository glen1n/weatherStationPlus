<?php

// Include Database Class

include 'db.php';

// Start Database Object
$db = new DB();

// Write SQL Statement to insert weatherlog info
// $sql = "INSERT INTO `weatherStation`.`weatherlog` (`weatherlog_id`, `weatherlog_time`, `weatherlog_temperature`, `weatherlog_humidity`, `weatherlog_barometric`) VALUES (NULL, '2014-07-03 11:21:00', '99', '43', '30.20');"
date_default_timezone_set('America/Phoenix');
$currentTime = date('Y-m-d H:i:s');
$randTemperature = floatVal(rand(1,139).'.'.rand(0, 99));
$randHumidity = floatVal(rand(1,99).'.'.rand(0, 99));
$randBarometric = floatVal(rand(28, 31).'.'.rand(0, 99));

// print_r($currentTime .' ');
// print_r($randTemperature .' ');
// print_r($randHumidity. ' ');
// print_r($randBarometric. ' ');

$sql = "INSERT INTO `weatherStation`.`weatherlog` (`weatherlog_id`, 
    `weatherlog_time`, `weatherlog_temperature`, 
    `weatherlog_humidity`, `weatherlog_barometric`) 
     VALUES (NULL, '$currentTime', '$randTemperature', 
        '$randHumidity', '$randBarometric')";
// print_r($sql);
// echo $sql;
// Execute SQL Statement
$results = $db->execute($sql);

// Write SQL Statement to insert pirmotionlog info
// $sql = "INSERT INTO `weatherStation`.`pirmotionlog` (`pirmotion_id`, `pirmotion_count`, `pirmotion_time`) VALUES (NULL, '10','2014-07-03 11:21:00');"

date_default_timezone_set('America/Phoenix');
$currentTime = date('Y-m-d H:i:s');
$randCount = rand(1,50);

// print_r($currentTime .' ');
// print_r($randCount .' ');

$sql = "INSERT INTO `weatherStation`.`pirmotionlog` 
       (`pirmotion_id`, `pirmotion_count`, `pirmotion_time`) 
       VALUES (NULL, '$randCount', '$currentTime')";


// $sql = "INSERT INTO `weatherStation`.`pirmotionlog`
//        (`pirmotion_id`, 'pirmotion_count', 'pirmotion_time')
//         VALUES (NULL, '$randCount', '$currentTime')";
// // print_r($sql);
// echo $sql;
// Execute SQL Statement
$results = $db->execute($sql);

// print_r($results);

// if ($results->num_rows != 0) {

 
    // search through the database and pull the matching results
    // while ($row = $results->fetch_assoc()) {

        // $response = $row;

    // }
   
    // header('Content-type: application/json');

    // echo json_encode($response);
    
// } else {

    // http_response_code(400); 
// }

?>