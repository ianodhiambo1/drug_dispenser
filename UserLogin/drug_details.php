<!DOCTYPE html>
<html>
<head>
    <title>Drug Details</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Drug Details</h1>
    <?php
    // Connect to the database 
    include 'config.php';
    session_start();
    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
    header('location:login2.php');
    };

    if(isset($_GET['logout'])){
    unset($user_id);
    session_destroy();
    header('location:login2.php');
    };

    // Check if the dr_id parameter exists in the URL
    if (isset($_GET['dr_id'])) {
        $drId = $_GET['dr_id'];

        // Retrieve drug information based on the provided dr_id
        $query = "SELECT * FROM drug_info WHERE dr_id = $drId";
        $result = mysqli_query($conn, $query);

        // Display drug information
        if ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='details'>";
            echo "<div class='name'><span class='title'>Name:</span>{$row['dr_name']}</div>";
            echo "<div class='pharm-company'><span class='title'>Pharmaceutical Company:</span> {$row['dr_pharmCompany']}</div>";
            echo "<div class='descript'><span class='title'>Description:</span> {$row['dr_description']}</div>";
            echo "<div class='price'><span class='title'>Price:</span> {$row['dr_price']}</div>";
            echo "<div class='symptoms'><span class='title'>Symptoms:</span> {$row['dr_symptoms']}</div>";
            echo "<div class='ingredients'><span class='title'>Ingredients:</span> {$row['dr_ingredients']}</div>";
            echo "</div>";
        } else {
            echo "Drug not found.";
        }
    } else {
        echo "No drug selected.";
    }
    ?>
</body>
</html>
