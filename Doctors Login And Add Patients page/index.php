<?php

require_once 'db_connect.php';

// Fetch data from the table
$sql = "SELECT * FROM patients";
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . "<br>";
        echo "Email: " . $row["email"] . "<br>";
        echo "Password: " . $row["password"] . "<br><br>";
    }
} else {
    echo "No users found.";
}

// Close the database connection
$conn->close();
?>







