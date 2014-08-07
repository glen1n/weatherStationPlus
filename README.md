weatherStationPlus

NOTE: This project is under development and only partially functional.

A web page for status output and control panel for my Arduino weather station sensor experiments. 

There are three major pieces to the project.

1. An Arduino with sensors and XBee radio connected, running code that responds to commands and returns data collected from the connected sensors.

2. A server running code that issues commands to a serial port with an XBee radio paired to the radio on the Arduino and recieves data from
   the Arduino which it then stores in a database.

3. The web UI with graphical gauges, graphs, charts, buttons, and switches to display sensor data that has been stored in the database, 
   accept input commands to be sent to the Arduino board, or enter configuration information to be stored in the database.
   
   
