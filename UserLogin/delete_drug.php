<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $drug_id = $_GET['id'];

    // Assuming you have established a database connection ($conn)
    include 'config.php';

    // Perform the delete query
    $delete_query = "DELETE FROM `drug_info` WHERE `dr_id` = '$drug_id'";
    $result = mysqli_query($conn, $delete_query);

    if ($result) {
        // Redirect to the drug listing page after successful deletion
        header("Location: admin_home.php");
        exit;
    } else {
        echo "Failed to delete the drug. Please try again.";
    }
} else {
    echo "Invalid drug ID.";
}
?>
