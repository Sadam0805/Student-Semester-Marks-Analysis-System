<?php
$hostname = "localhost"; // usually "localhost"
$username = "root";
$password = "";
$database = "saranya";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
