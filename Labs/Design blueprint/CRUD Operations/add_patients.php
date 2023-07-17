<!DOCTYPE html>
<html>
<head>
  <title>Add Patient - PHP</title>
  <style>
    label {
      display: inline-block;
      width: 100px;
    }
    input[type="text"] {
      width: 700px;
      height: 50px;
    }
    input[type="submit"] {
      margin-top: 10px;
      padding: 4px 8px;
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
    }
  </style>
</head>
<body>
<?php
// Database connection
include('config.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the submitted values
  $pt_fname = $_POST["pt_fname"];
  $pt_lname = $_POST["pt_lname"];
  $pt_age = $_POST["pt_age"];
  $pt_address = $_POST["pt_address"];

  // Insert the new patient into the database
  $query = "INSERT INTO patients (pt_fname, pt_lname, pt_age, pt_address) VALUES ('$pt_fname', '$pt_lname', '$pt_age', '$pt_address')";

  if (mysqli_query($conn, $query)) {
    echo "New patient added successfully.";
  } else {
    echo "Error adding patient: " . mysqli_error($conn);
  }
}

mysqli_close($conn);
?>

<h2>Add Patient</h2>
<form method="POST" action="">
  <label for="pt_fname">First Name:</label>
  <input type="text" name="pt_fname"><br>
  <label for="pt_lname">Last Name:</label>
  <input type="text" name="pt_lname"><br>
  <label for="pt_age">Age:</label>
  <input type="text" name="pt_age"><br>
  <label for="pt_address">Address:</label>
  <input type="text" name="pt_address"><br>
  <input type="submit" value="Add Patient">
</form>

</body>
</html>