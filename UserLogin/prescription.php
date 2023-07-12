
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Prescription</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

   <h2>Prescription</h2>
    <div class="diagnosis">
    <?php
    include 'config.php';

    

    


    // Display the prescription data in an HTML table
    echo "<table class='styled-table'>
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
    ?>
    
</div>

</body>
</html>