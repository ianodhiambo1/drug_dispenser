<?php
// Establish database connection
include 'config.php';
// Check if the pharmacist is logged in
session_start();
$user_id = $_SESSION['pharm_id'];

if(!isset($user_id)){
   header('location:pharm_login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:pharm_login.php');
};

// Fetch patient's prescriptions from the database
$sql = "SELECT * FROM prescription";
$result = mysqli_query($conn, $sql);

// Fetch drug prices from the database
$sql_prices = "SELECT * FROM drug_info";
$result_prices = mysqli_query($conn, $sql_prices);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Prescription List</title>
    <style>
        body {
            background-color: #f5f5f5;
        }
        .prescription-table {
            width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            padding: 20px;
        }
        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
    
        ol {
            list-style-type: decimal;
            padding-left: 20px;
            text-align: center;
            list-style-type: none;
        }
    
        .name {
            margin-bottom: 10px;
        }
    
        .name a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
    
        .name a:hover {
            text-decoration: underline;
        }
        .prescription-table h2 {
            text-align: center;
        }
        .prescription-table table {
            width: 100%;
            border-collapse: collapse;
        }
        .prescription-table th, .prescription-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }
        .navbar {
        background-color: grey;
        padding: 10px;
        display: flex;
        justify-content: space-between;
        width: 700px;
        margin: 10px auto;
        border: solid white 1px;
        border-radius: 6px;
    }

    .navbar-brand {

        margin-right: 10px;
        font-weight: bold;
        font-size: 30px;
    }

    .navbar-username {
        margin-right: 10px;
        font-weight: bold;
        font-size: 30px;
    }

    .navbar-logout {
        background-color: #dc3545;
        color: #fff;
        border: none;
        padding: 8px 12px;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
    }
    </style>
</head>
<body>
<?php
      $select_user = mysqli_query($conn, "SELECT * FROM `pharmacists` 
      WHERE pharm_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
      };
   ?>
<div class="navbar">
    <span class="navbar-brand">Pharmacist Dashboard</span>
    <button onclick="window.location.href='history.php'">View History</button>
    <a class="navbar-logout" href="index2.php?logout=<?php echo $user_id; ?>" 
         onclick="return confirm('are your sure you want to logout?');" class="logOut">Log out</a>
      <span class="navbar-username"><?php echo $fetch_user['pharm_username']; ?></span>
</div>
    <div class="prescription-table">
    <h2>Prescription List</h2>
<?php if (mysqli_num_rows($result) > 0) : ?>
    <table>
        <thead>
            <tr>
                <th>Prescription ID</th>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th>Diagnosis</th>
                <th>List of Drugs</th>
                <th>Additional Information</th>
                <th>Patient ID</th>
                <th>Date Written</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $row['pr_id']; ?></td>
                    <td>
                        <?php
                        $patientId = $row['patient_id'];
                        $patientQuery = mysqli_query($conn, "SELECT CONCAT(fName, ' ', lName) AS patient_name FROM user_info WHERE id = $patientId");
                        $patientData = mysqli_fetch_assoc($patientQuery);
                        echo $patientData['patient_name'];
                        ?>
                    </td>
                    <td><?php echo $row['pr_name']; ?></td>
                    <td><?php echo $row['pr_diagnosis']; ?></td>
                    <td><?php echo $row['pr_ListOdrugs']; ?></td>
                    <td><?php echo $row['pr_AdditonalInfo']; ?></td>
                    <td><?php echo $row['patient_id']; ?></td>
                    <td><?php echo $row['pr_date_written']; ?></td>
                </tr>
                <?php mysqli_data_seek($result_prices, 0); ?>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else : ?>
    <p>No prescriptions found for the specified patient.</p>
<?php endif; ?>

    </div>





<h1>List of Patients</h1>

<ol>
    <?php
    $select_user = mysqli_query($conn, "SELECT * FROM `user_info`") or die('query failed');
    if (mysqli_num_rows($select_user) > 0) {
        while ($fetch_user = mysqli_fetch_assoc($select_user)) {
            $id = $fetch_user['id'];
            $fname = $fetch_user['fName'];
            $lname = $fetch_user['lName'];
            ?>
            <li class="name"><?php echo "<a href='prescriptions.php?id=$id'>$fname $lname</a>"; ?></li>
            <?php
        }
    }
    ?>
</ol>


<button class="name" onclick="window.location.href='Dispense.php'">Dispense Drugs</button><br>

</body>
</html>
