<?php

// Variables
$servername = "localhost";
$username = "ccm_mk";
$password = "LLUg63[XFBY_";
$dbname = "ccm_mk";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully to database!!!";

?>

<!-- "LLUg63[XFBY_"; -->
