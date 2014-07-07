<!DOCTYPE html>
<html>
<head>
    <title>Testing php to ttyUSB0 serial connection.</title>
</head>
<body>

</body>
</html>
<?php
include 'PhpSerial.php';
// echo '<p>BEGIN GGG X1  </p>';
// Let's start the class
$serial = new PhpSerial;
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
sleep(1);
//read from
$temperature = '';

$temperature = $serial->readPort();
echo $temperature . ' <br>';

$serial->sendMessage('H');
sleep(1);
//read from
$humidity = '';

$humidity = $serial->readPort();
echo $humidity . ' <br>';

$serial->sendMessage('P');
sleep(2);
//read from
$barometric = '';

$barometric = $serial->readPort();
echo $barometric . ' <br>';

$serial->sendMessage('C');
sleep(1);
//read from
$count = '';

$count = $serial->readPort();
echo $count . ' <br>';

$temperature = mb_substr($temperature, 1);
$temperature = trim($temperature);
$humidity = mb_substr($humidity, 1);
$humidity = trim($humidity);
$barometric = mb_substr($barometric, 1);
$barometric = trim($barometric);
$count = mb_substr($count, 1);
$count = trim($count);
// $count = substr($count, 2);
echo ' <br>';
echo $temperature . ' <br>';
echo $humidity . ' <br>';
echo $barometric . ' <br>';
echo $count . ' <br>';

// echo '<p>READ GGG X4 </p>';
// echo $read . '... <br>';
// echo '<p>READ GGG X5 </p>';

// If you want to change the configuration, the device must be closed
$serial->deviceClose();

// We can change the baud rate
// $serial->confBaudRate(9600);

// etc...
//
//
/* Notes from Jim :
> Also, one last thing that would be good to document, maybe in example.php:
>  The actual device to be opened caused me a lot of confusion, I was
> attempting to open a tty.* device on my system and was having no luck at
> all, until I found that I should actually be opening a cu.* device instead!
>  The following link was very helpful in figuring this out, my USB/Serial
> adapter (as most probably do) lacked DTR, so trying to use the tty.* device
> just caused the code to hang and never return, it took a lot of googling to
> realize what was going wrong and how to fix it.
>
> http://lists.apple.com/archives/darwin-dev/2009/Nov/msg00099.html

Riz comment : I've definately had a device that didn't work well when using cu., but worked fine with tty. Either way, a good thing to note and keep for reference when debugging.
 */