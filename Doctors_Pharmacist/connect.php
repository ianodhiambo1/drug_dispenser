<?php
$servername = "localhost";
$username = "root";
$password = "";
$name = "patientsd";


$conn = new mysqli ($servername,$username,$password,$name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "";

 ?>