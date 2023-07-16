<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ID = mysqli_real_escape_string($conn, $_POST['pt_ID']);
    $fName = mysqli_real_escape_string($conn, $_POST['pt_fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['pt_lname']);
    $age = mysqli_real_escape_string($conn, $_POST['pt_age']);
    $address = mysqli_real_escape_string($conn, $_POST['pt_address']);

    $select = mysqli_query($conn, "SELECT * FROM `patients` WHERE pt_ID = $ID");

    if (mysqli_num_rows($select) > 0) {
       echo 'User already exists!';
    } else {
        mysqli_query($conn, "INSERT INTO `patients` (pt_ID, pt_fname, pt_lname, pt_age, pt_address) VALUES ($ID, '$fName', '$lname', '$age', '$address')") or die('Query failed');
        echo 'Registered successfully!';
    }
}
?>

<DOCTYPE! html>
    <html>

    <link rel = "stylesheet" href = "style.css">
        <head>
            <title>Add Patients</title>
<h2>
            <header> Add Patients</header>
            </h2>
        </head>
        <body>
            
        <form action="addpatient.php" method="POST">
        <label for="pt_ID">ID:</label>
        <input type="text" id="pt_ID" name="pt_ID" required><br><br>

        <label for="pt_fname">First Name:</label>
        <input type="text" id="pt_fname" name="pt_fname" required><br><br>

        <label for="pt_lname">Last Name:</label>
        <input type="text" id="pt_lname" name="pt_lname" required><br><br>

        <label for="pt_age">Age:</label>
        <input type="text" id="pt_age" name="pt_age" required><br><br>

        <label for="pt_address">Address:</label>
        <input type="text" id="pt_address" name="pt_address" required><br><br>

        <input type="submit" value="Register">
    </form>
        </body>
    </html>