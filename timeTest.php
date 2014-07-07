<?php

echo date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);

echo "<br>";
echo "
If you omit the second parameter the current value of time() will be used.
 <br>";

echo "<br>";
echo date('Y-m-d H:i:s');
echo "<br>";


echo floatVal(rand(28, 31).'.'.rand(0, 99)); 
echo "<br>";

