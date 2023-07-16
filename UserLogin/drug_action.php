<?php



include 'config.php';
if (isset($_POST['delete_dr'])) {
    $id = $_POST['delete_dr'];
    $query = "DELETE FROM drug_info WHERE dr_id = '$id'";
    mysqli_query($conn, $query);
  }
   // Handle update button click
if (isset($_POST['update_dr'])) {
  $id = $_POST['update_dr'];
  header('location:update_page.php?id='.$id);
  exit();
}
    ?>