<?php

require_once 'connect.php';

// Fetch data from the table
$sql = "SELECT * FROM patients";
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "pt_ID: " . $row["pt_ID"] . "<br>";
        echo "pt_fname: " . $row["pt_fname"] . "<br>";
        echo "pt_lname: " . $row["pt_lname"] . "<br><br>";
    }
} else {
    echo "No users found.";
}

// Close the database connection
$conn->close();
?>
