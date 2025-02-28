<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "voting_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set to UTF-8 for proper encoding
$conn->set_charset("utf8");
?>
