<?php


include 'config.php';
$selectQuery = "SELECT * FROM drug_info";
$result2 = mysqli_query($conn, $selectQuery);
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Pharmaceutical Company</th>
                <th>Description</th>
                <th>Price</th>
                <th>Symptoms</th>
                <th>Ingredients</th>
                <th>Ingredients</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result2)) : ?>
                <tr>
                    <td><?php echo $row['dr_id']; ?></td>
                    <td><?php echo $row['dr_name']; ?></td>
                    <td><?php echo $row['dr_pharmCompany']; ?></td>
                    <td><?php echo $row['dr_description']; ?></td>
                    <td><?php echo $row['dr_price']; ?></td>
                    <td><?php echo $row['dr_symptoms']; ?></td>
                    <td><?php echo $row['dr_ingredients']; ?></td>
                    <td><form method='POST' onsubmit="return confirm('Are you sure you want to modify this record?')" action="">
              <button type='submit' name='delete_dr' value="<?php echo $data['dr_id']; ?> "  class="action">Delete</button>
              <button type='submit' name='update_dr' value="<?php echo $data['dr_id']; ?> " class="action">Update</button>
              </form></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
