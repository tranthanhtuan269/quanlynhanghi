<?php
$servername = "localhost";
$username = "admin_nhanghi";
$password = "Xl0ThJpUwT";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>