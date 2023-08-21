<?php
/* variables for connection to database */
$host = "localhost";
$dbname = "studentlogin_db";
$username = "root"; /* connecting with root account */ 
$password = "";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_errno);
}

return $mysqli; /* if there's an error, what do you return? 
the error code? or does it not return? */

?>