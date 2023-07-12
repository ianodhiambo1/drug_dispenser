<?php
include 'config.php';

// Fetch the prescription data from the database
$query = "SELECT * FROM prescription";
$result = mysqli_query($conn, $query);

// Display the prescription data in an HTML table
echo "<table>
        <tr>
            <th>Prescription ID</th>
            <th>Name</th>
            <th>Diagnosis</th>
            <th>Medications</th>
            <th>Additional Info</th>
            <th>Patient ID</th>
            <th>Date Written</th>
        </tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>".$row['pr_id']."</td>
            <td>".$row['pr_name']."</td>
            <td>".$row['pr_diagnosis']."</td>
            <td>".$row['pr_ListOdrugs']."</td>
            <td>".$row['pr_AdditonalInfo']."</td>
            <td>".$row['patient_id']."</td>
            <td>".$row['pr_date_written']."</td>
          </tr>";
}

echo "</table>";

// Close the database connection
mysqli_close($conn);
?>
