<?php
$servername = "remotemysql.com";
$username = "QU3wVveWyh";
$password = "HCBQPFifBB";
$dbname = "QU3wVveWyh";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
