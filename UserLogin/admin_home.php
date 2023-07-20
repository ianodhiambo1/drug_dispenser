<!DOCTYPE html>
<html>
<head>
    <title>Admin Homepage</title>
    <style>
        /* Add your CSS styling here */
    </style>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    session_start();

    // Check if the user is logged in as an admin
    if (!isset($_SESSION["admin_id"])) {
        header("Location: admin_login.php");
        exit;
    }

    // Database connection
    include('config.php');

    // Retrieve admin details
    $adminId = $_SESSION["admin_id"];
    $query = "SELECT * FROM admins WHERE admin_id='$adminId'";
    $result = mysqli_query($conn, $query);
    $admin = mysqli_fetch_assoc($result);
    $sql = "SELECT * FROM drug_info";
    $resultQuery = mysqli_query($conn, $sql);
    

    // Retrieve patient data
    $patientQuery = "SELECT * FROM patients";
    $patientResult = mysqli_query($conn, $patientQuery);
    ?>

    <nav>
        <div class="navbar" style="border: black solid 1px; width:fit-content; margin: 0 auto; padding-inline:10px;">
            <span class="admin-name"><?php echo $admin["admin_full_name"]; ?></span>
            <a class="btn" href="logout.php">Logout</a>
            <button><a href="add_drugs.php">Add Drugs</a></button>
        </div>
    </nav>
    <h2>Welcome, <?php echo $admin["admin_full_name"]; ?></h2>
    <h3>Patient Data</h3>
<div class="tables"  >
    <table class="styled-table">
        <thead>
            <tr>
                <th>Patient ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($patient = mysqli_fetch_assoc($patientResult)) : ?>
                <tr>
                    <td><?php echo $patient["pt_ID"]; ?></td>
                    <td><?php echo $patient["pt_fname"]; ?></td>
                    <td><?php echo $patient["pt_lname"]; ?></td>
                    <td><?php echo $patient["pt_age"]; ?></td>
                    <td><?php echo $patient["pt_address"]; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <table class="styled-table">
    <thead>
        <tr>
            <th>Drug ID</th>
            <th>Name</th>
            <th>Pharmaceutical Company</th>
            <th>Description</th>
            <th>Price</th>
            <th>Symptoms</th>
            <th>Ingredients</th>
            <th>Actions</th> <!-- New column for buttons -->
        </tr>
    </thead>
    <tbody>
        <?php while ($drug = mysqli_fetch_assoc($resultQuery)) : ?>
            <tr>
                <td><?php echo $drug["dr_id"]; ?></td>
                <td><?php echo $drug["dr_name"]; ?></td>
                <td><?php echo $drug["dr_pharmCompany"]; ?></td>
                <td><?php echo $drug["dr_description"]; ?></td>
                <td><?php echo $drug["dr_price"]; ?></td>
                <td><?php echo $drug["dr_symptoms"]; ?></td>
                <td><?php echo $drug["dr_ingredients"]; ?></td>
                <td>
                    <!-- Add buttons with links to the edit and delete pages -->
                    <a href="update_drug.php?id=<?php echo $drug["dr_id"]; ?>">Update</a>
                    <a href="delete_drug.php?id=<?php echo $drug["dr_id"]; ?>">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>




</div>



    <?php mysqli_close($conn); ?>
</body>
</html>
