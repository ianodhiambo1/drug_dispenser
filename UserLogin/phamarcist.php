<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacist</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <h1>Precriptions</h1>
<?php
include 'config.php';

// Fetch the prescription data from the database
$query = "SELECT * FROM prescription";
$result = mysqli_query($conn, $query);

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
    <h1>List of Patients</h1>

<ol>
<?php
  $select_user = mysqli_query($conn, "SELECT * FROM `user_info`") or die('query failed');
  if(mysqli_num_rows($select_user) > 0){
     while($fetch_user = mysqli_fetch_assoc($select_user)){
?>
     <?php $id = $fetch_user['id'];
        $fname = $fetch_user['fName'] ;
        $lname = $fetch_user['lName'] ; ?>
     <div class="name"><?php echo "<a href='prescription.php?id=$id'>$fname $lname</a>"; ?></div>
</ol>
<?php
  };
};
?>
    
</body>
</html>

