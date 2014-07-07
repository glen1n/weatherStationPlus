<?php
// Include serial support
include 'comms/PhpSerial.php';

// Include Database Class
include 'db.php';

// echo '<p>BEGIN GGG X1  </p>';
// Let's start the class
$serial = new PhpSerial;
// Start Database Object
$db = new DB();
// echo '<p>SET GGG X2 </p>';

// First we must specify the device. This works on both linux and windows (if
// your linux serial device is /dev/ttyS0 for COM1, etc)
$serial->deviceSet("/dev/ttyUSB0");

// We can change the baud rate, parity, length, stop bits, flow control
// $serial->confBaudRate(9600);
// $serial->confParity("none");
// $serial->confCharacterLength(8);
// $serial->confStopBits(1);
// $serial->confFlowControl("none");
// $serial->confPortEcho("off");

// echo '<p>OPEN GGG X3 </p>';
// Then we need to open it
$serial->deviceOpen();
sleep(5);

// To write into
$serial->sendMessage('T');
sleep(2);
//read from
$temperature = '';
$temperature = $serial->readPort();

$serial->sendMessage('H');
sleep(2);
//read from
$humidity = '';
$humidity = $serial->readPort();

$serial->sendMessage('P');
sleep(2);
//read from
$barometric = '';
$barometric = $serial->readPort();

$serial->sendMessage('C');
sleep(1);
//read from
$count = '';
$count = $serial->readPort();

$temperature = mb_substr($temperature, 1);
$temperature = trim($temperature);
$humidity = mb_substr($humidity, 1);
$humidity = trim($humidity);
$barometric = mb_substr($barometric, 1);
$barometric = trim($barometric);
$count = mb_substr($count, 1);
$count = trim($count);

echo $temperature;
echo $humidity;
echo $barometric;
echo $count;
// echo '<p>READ GGG X4 </p>';

// If you want to change the configuration, the device must be closed
$serial->deviceClose();

// Write SQL Statement to insert weatherlog info
// $sql = "INSERT INTO `weatherStation`.`weatherlog` (`weatherlog_id`, `weatherlog_time`, `weatherlog_temperature`, `weatherlog_humidity`, `weatherlog_barometric`) VALUES (NULL, '2014-07-03 11:21:00', '99', '43', '30.20');"
date_default_timezone_set('America/Phoenix');
$currentTime = date('Y-m-d H:i:s');

$sql = "INSERT INTO `weatherStation`.`weatherlog` (`weatherlog_id`, 
    `weatherlog_time`, `weatherlog_temperature`, 
    `weatherlog_humidity`, `weatherlog_barometric`) 
     VALUES (NULL, '$currentTime', '$temperature', 
        '$humidity', '$barometric')";
// print_r($sql);
// echo $sql;
// Execute SQL Statement
$results = $db->execute($sql);

// Write SQL Statement to insert pirmotionlog info
// $sql = "INSERT INTO `weatherStation`.`pirmotionlog` (`pirmotion_id`, `pirmotion_count`, `pirmotion_time`) VALUES (NULL, '10','2014-07-03 11:21:00');"

$sql = "INSERT INTO `weatherStation`.`pirmotionlog` 
       (`pirmotion_id`, `pirmotion_count`, `pirmotion_time`) 
       VALUES (NULL, '$count', '$currentTime')";

// Execute SQL Statement
$results = $db->execute($sql);
