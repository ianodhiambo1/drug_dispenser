<?php
// Establish database connection
include 'config.php';

// Query the database to retrieve the drug list
$sql = "SELECT * FROM drug_info";
$result = mysqli_query($conn, $sql);

// Create an array to store the drug list
$drugList = array();

// Fetch the drug list and format it as an array of drug objects
while ($row = mysqli_fetch_assoc($result)) {
    $drug = array(
        'id' => $row['dr_id'],
        'name' => $row['dr_name']
    );

    // Add the drug to the drug list array
    $drugList[] = $drug;
}

// Close the database connection
mysqli_close($conn);

// Return the drug list as JSON data
header('Content-Type: application/json');
echo json_encode($drugList);
