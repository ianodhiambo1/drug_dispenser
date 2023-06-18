<?php
$servername = "localhost";
$username = "root";
$password = "";
$name = "patients#2"




$conn = new mysqli ($servername,$username,$password,$name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";

 ?>
