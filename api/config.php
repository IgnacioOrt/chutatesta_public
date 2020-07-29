<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chuta";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
include_once("const.php");
include_once("utils.php");
?> 