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

    <?php mysqli_close($conn); ?>
</body>
</html>
