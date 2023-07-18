<?php

include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pt_ID = mysqli_real_escape_string($conn, $_POST['DD_pt_id']);
    $Add_info = mysqli_real_escape_string($conn, $_POST['DD_AddInfo']);
    $list = mysqli_real_escape_string($conn, $_POST['DD_List']);
    $price = mysqli_real_escape_string($conn, $_POST['DD_Price']);
    $date = date("Y-m-d");

    $query = mysqli_query($conn, "INSERT INTO `dispensed_drugs` (DD_pt_id, DD_AddInfo, DD_List, DD_Price, DD_Date) VALUES ('$pt_ID','$Add_info','$list','$price','$date')") or die('Query failed');

    if ($query) {
        echo "Drugs Dispensed";
        header('location: pharmacist.php');
    } else {
        echo "Could not dispense drugs: " . mysqli_error($conn);
    }
}

?>




<!DOCTYPE html>
<html>
    <link rel = "stylesheet" href = "style3.css">
<head>
    <title>
        Dispense Drugs
    </title>
    <header style="height:50px;"> 
        <div>
        <h1>Dispense Drugs </h1> 
    </div>

      <div> 
    <button onclick="window.location.href='pharmacist.php'">Home Page</button>
    <button onclick="window.location.href='history.php'">View History</button>
    </div> 
         </header>
</head>






<body>
    
<div class = "box">
<form action="Dispense.php" method="POST">
<label for="DD_pt_id">Patients ID </label>
<input type="text" id="DD_pt_id" name="DD_pt_id" required><br><br>
<div class = "spacing"></div> 


<label for="DD_List">List of Drugs: </label>
<textarea type="text" id="DD_List" name="DD_List" required></textarea><br><br>
<div class = "spacing"></div> 


<label for="DD_AddInfo">Additional Info: </label>
<textarea type="text" id="DD_AddInfo" name="DD_AddInfo" required></textarea><br><br>
<div class = "spacing"></div> 


<label for="DD_Price">Price: ksh </label>
<input type="text" id="DD_Price" name="DD_Price" required><br><br>
<div class = "spacing"></div> 

<button><input type="submit" value="Dispense"></button>

</form>

</div>
</body>



</html>
