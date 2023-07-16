<!DOCTYPE html>
<html>
<head>
  <title>Update Patient - PHP</title>
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
  $pt_ID = $_POST["pt_ID"];
  $pt_fname = $_POST["pt_fname"];
  $pt_lname = $_POST["pt_lname"];
  $pt_age = $_POST["pt_age"];
  $pt_address = $_POST["pt_address"];

  // Update the record in the database
  $query = "UPDATE patients SET pt_fname='$pt_fname', pt_lname='$pt_lname', pt_age='$pt_age', pt_address='$pt_address' WHERE pt_ID='$pt_ID'";

  if (mysqli_query($conn, $query)) {
    echo "Record updated successfully.";
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
}

// Retrieve the pt_SSN value from the URL parameter
$pt_ID = $_GET["id"];

// Fetch the existing patient details
$query = "SELECT * FROM patients WHERE pt_ID='$pt_ID'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>

<h2>Update Patient</h2>
<form method="POST" action="">
  <input type="hidden" name="pt_ID" value="<?php echo $row['pt_ID']; ?>">
  <label for="pt_fname">First Name:</label>
  <input type="text" name="pt_fname" value="<?php echo $row['pt_fname']; ?>"><br>
  <label for="pt_lname">Last Name:</label>
  <input type="text" name="pt_lname" value="<?php echo $row['pt_lname']; ?>"><br>
  <label for="pt_age">Age:</label>
  <input type="text" name="pt_age" value="<?php echo $row['pt_age']; ?>"><br>
  <label for="pt_address">Address:</label>
  <input type="text" name="pt_address" value="<?php echo $row['pt_address']; ?>"><br>
  <input type="submit" value="Update">
</form>

</body>
</html>
