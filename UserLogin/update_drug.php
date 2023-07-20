<!DOCTYPE html>
<html>
<head>
    <title>Edit Drug Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: inline-block;
            width: 150px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            width: 100%;
            height: 150px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            resize: vertical; /* Allows vertical resizing */
        }

        input[type="submit"] {
            background-color: #394CFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #2939B3;
        }
    </style>
</head>
<body>
    <?php
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $drug_id = $_GET['id'];

        // Assuming you have established a database connection ($conn)
        include 'config.php';
        // Retrieve the drug data from the database based on the ID
        $select_drug = mysqli_query($conn, "SELECT * FROM `drug_info` WHERE `dr_id` = '$drug_id'");
        $drug_data = mysqli_fetch_assoc($select_drug);

        if (!$drug_data) {
            echo "Drug not found.";
            exit;
        }
    } else {
        echo "Invalid drug ID.";
        exit;
    }

    // Handle the form submission for updating the drug
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Get the updated drug data from the form
        $updated_dr_name = $_POST['dr_name'];
        $updated_pharm_company = $_POST['dr_pharmCompany'];
        $updated_dr_description = $_POST['dr_description'];
        $updated_dr_price = $_POST['dr_price'];
        $updated_dr_symptoms = $_POST['dr_symptoms'];
        $updated_dr_ingredients = $_POST['dr_ingredients'];

        // Assuming you have established a database connection ($conn)
        // Perform the update query
        $update_query = "UPDATE `drug_info` SET 
        `dr_name` = '$updated_dr_name',
         `dr_pharmCompany` = '$updated_pharm_company',
          `dr_description` ='$updated_dr_description',
          `dr_symptoms` ='$updated_dr_symptoms',
           `dr_price` ='$updated_dr_price', 
           `dr_ingredients` ='$updated_dr_ingredients'
                WHERE `dr_id` = '$drug_id'";
        $result = mysqli_query($conn, $update_query);

        if ($result) {
            // Redirect to the drug listing page after successful update
            header("Location: admin_home.php");
            exit;
        } else {
            echo "Failed to update the drug. Please try again.";
        }
    }
    ?>

    <div class="container">
        <h2>Edit Drug Information</h2>
        <form action="" method="POST">
            <label for="dr_name">Drug Name:</label>
            <input type="text" id="dr_name" name="dr_name" value="<?php echo $drug_data['dr_name']; ?>" required><br><br>

            <label for="dr_pharmCompany">Pharmaceutical Company:</label>
  <input type="text" name="dr_pharmCompany" value="<?php echo $drug_data['dr_pharmCompany']; ?>"><br>
  <label for="dr_description">Description:</label>
  <textarea name="dr_description"><?php echo $drug_data['dr_description']; ?></textarea><br>
  <label for="dr_price">Price:</label>
  <input type="text" name="dr_price" value="<?php echo $drug_data['dr_price']; ?>"><br>
  <label for="dr_symptoms">Symptoms:</label>
  <textarea name="dr_symptoms"><?php echo $drug_data['dr_symptoms']; ?></textarea><br>
  <label for="dr_ingredients">Ingredients:</label>
  <textarea name="dr_ingredients"><?php echo $drug_data['dr_ingredients']; ?></textarea><br>
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
