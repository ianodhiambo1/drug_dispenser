<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name = mysqli_real_escape_string($conn, $_POST['dr_name']);
    $PC = mysqli_real_escape_string($conn, $_POST['dr_pharmCompany']);
    $descr = mysqli_real_escape_string($conn, $_POST['dr_description']);
    $price = mysqli_real_escape_string($conn, $_POST['dr_price']);
    $symptoms = mysqli_real_escape_string($conn, $_POST['dr_symptoms']);
    $ingr = mysqli_real_escape_string($conn, $_POST['dr_ingredients']);

    $select = mysqli_query($conn, "SELECT * FROM `drug_info`");

    if (mysqli_num_rows($select) > 0) {
        mysqli_query($conn, "INSERT INTO `drug_info` ( dr_name, dr_pharmCompany, dr_description, dr_price, dr_symptoms, dr_ingredients) VALUES ( '$Name', '$PC', '$descr', '$price', '$symptoms', '$ingr')") or die('Query failed');
        echo 'Added drug successfully!';
    } else {
        echo 'Add drug failed';
    }
}
?>

<DOCTYPE! html>
    <html>

    <link rel = "stylesheet" href = "style3.css">
        <head>
            <title>Add Drug</title>
            <style>
                        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
            color: #394CFF;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: inline-block;
            width: 120px;
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
        button{
            background-color: #394CFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

            </style>
            
        </head>
        <body>
        
            
        <form action="add_drugs.php" method="POST">
        <button onclick="window.location.href='admin_home.php'">Back Home</button><br>

        <label for="dr_name">Name:</label>
        <input type="text" id="dr_name" name="dr_name" required><br><br>

        <label for="dr_pharmCompany">Pharmaceutical Company:</label>
        <input type="text" id="dr_pharmCompany" name="dr_pharmCompany" required><br><br>

        <label for="dr_description">Description:</label>
        <input type="text" id="dr_description" name="dr_description" required><br><br>

        <label for="dr_price">Price:</label>
        <input type="text" id="dr_price" name="dr_price" required><br><br>

        <label for="dr_symptoms">Symptoms:</label>
        <input type="text" id="dr_symptoms" name="dr_symptoms" required><br><br>

        <label for="dr_ingredients">Ingredients:</label>
        <input type="text" id="dr_ingredients" name="dr_ingredients" required><br><br>

        <input type="submit" value="Register">
    </form>
        </body>
    </html>