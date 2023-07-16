<!DOCTYPE html>
<html>
<head>
  <title>Update Drug - PHP</title>
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
  $dr_id = $_POST["dr_id"];
  $dr_name = $_POST["dr_name"];
  $dr_pharmCompany = $_POST["dr_pharmCompany"];
  $dr_description = $_POST["dr_description"];
  $dr_price = $_POST["dr_price"];
  $dr_symptoms = $_POST["dr_symptoms"];
  $dr_ingredients = $_POST["dr_ingredients"];

  // Update the record in the database
  $query = "UPDATE drug_info SET dr_name='$dr_name', dr_pharmCompany='$dr_pharmCompany', dr_description='$dr_description', dr_price='$dr_price', dr_symptoms='$dr_symptoms', dr_ingredients='$dr_ingredients' WHERE dr_id='$dr_id'";

  if (mysqli_query($conn, $query)) {
    echo "Record updated successfully.";
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
}

// Retrieve the dr_id value from the URL parameter
$dr_id = $_GET["id"];

// Fetch the existing drug details
$query = "SELECT * FROM drug_info WHERE dr_id='$dr_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>

<h2>Update Drug</h2>
<form method="POST" action="">
  <input type="hidden" name="dr_id" value="<?php echo $row['dr_id']; ?>">
  <label for="dr_name">Name:</label>
  <input type="text" name="dr_name" value="<?php echo $row['dr_name']; ?>"><br>
  <label for="dr_pharmCompany">Pharmaceutical Company:</label>
  <input type="text" name="dr_pharmCompany" value="<?php echo $row['dr_pharmCompany']; ?>"><br>
  <label for="dr_description">Description:</label>
  <textarea name="dr_description"><?php echo $row['dr_description']; ?></textarea><br>
  <label for="dr_price">Price:</label>
  <input type="text" name="dr_price" value="<?php echo $row['dr_price']; ?>"><br>
  <label for="dr_symptoms">Symptoms:</label>
  <textarea name="dr_symptoms"><?php echo $row['dr_symptoms']; ?></textarea><br>
  <label for="dr_ingredients">Ingredients:</label>
  <textarea name="dr_ingredients"><?php echo $row['dr_ingredients']; ?></textarea><br>
  <input type="submit" value="Update">
</form>

</body>
</html>
