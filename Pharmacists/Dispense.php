<?php

include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pt_ID = mysqli_real_escape_string($conn, $_POST['DD_pt_id']);
    $Add_info = mysqli_real_escape_string($conn, $_POST['DD_AddInfo']);
    $list = mysqli_real_escape_string($conn, $_POST['DD_List']);
    $price = mysqli_real_escape_string($conn, $_POST['DD_Price']);
    $date = mysqli_real_escape_string($conn, $_POST['DD_Date']);

    $query = mysqli_query($conn, "INSERT INTO `dispensed drugs` (DD_pt_id, DD_AddInfo, DD_List, DD_Price, DD_Date) VALUES ('$pt_ID','$Add_info','$list','$price','$date')") or die('Query failed');

    if ($query) {
        echo "Drugs Dispensed";
        header('location: pharmacist.php');
    } else {
        echo "Could not dispense drugs: " . mysqli_error($conn);
    }
}

?>


<<!DOCTYPE html>
<html>
    <link rel = "stylesheet" href = "style.css">
<head>
    <title>
        Dispense Drugs
    </title>
    <header> 
        Dispense Drugs 
        <a href = "pharmacist.php" class = "button">Home Page</a>
         </header>
</head>

<body>
    
<div class = "box">
<form action="Dispense.php" method="POST">
<label for="DD_pt_id">patients ID </label>
<input type="text" id="DD_pt_id" name="DD_pt_id" required><br><br>

<label for="DD_List">List of Drugs: </label>
<textarea type="text" id="DD_List" name="DD_List" required></textarea><br><br>


<label for="DD_AddInfo">Additional Info: </label>
<textarea type="text" id="DD_AddInfo" name="DD_AddInfo" required></textarea><br><br>

<label for="DD_Price">Price: ksh </label>
<input type="text" id="DD_Price" name="DD_Price" required><br><br>


<label for="DD_Date">Date: </label>
<input type="date" id="DD_Date" name="DD_Date" required><br><br>
<input type="submit" value="Dispense">

</form>

</div>
</body>



</html>
