<?php
$mysqli = new mysqli();
$mysqli->connect('127.0.0.1:3306', 'root', '', 'zijlspu40_cryptx');



if ($mysqli->connect_errno) { echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; } 

?>