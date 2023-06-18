<?php
$servername = "localhost";
$username = "root";
$password = "";
$name = "patients#2"

// $username = $_POST['username']
$firstname = $_POST['firstname'];
$secondname = $_POST['secondname'];
// $SSn = $_POST['SSn'];
$DoB = $_POST['DoB'];
// $Address = $_POST['Address']


//database connection


$conn = new mysqli ($servername,$username,$password,$name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";

// $sql = "SELECT firstname, secondname, DoB FROM patients";
// if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//     echo "<tr><td>" . $row["Dob"]. "</td><td>" . $row["firstname"] . "</td><td>"
//     . $row["secondname"]. "</td></tr>";
//     }
//     echo "</patients>";
//     } else { echo "0 results"; }
//     $conn->close();

// ?>
