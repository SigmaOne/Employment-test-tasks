<?php

$servername = "localhost";
$username = "root";
$password = getenv("MYSQL_ROOT_PASSWORD");

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
}

?>
