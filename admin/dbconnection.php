<?php
// Database connection parameters
$host = 'localhost'; // Hostname
$username = 'root'; // Database username
$password = ''; // Database password
$database = 'decoration'; // Database name

// Create a new connection to the database using mysqli
$conn = new mysqli($host, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
