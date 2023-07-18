<?php

include "connect.php";

$select = mysqli_query($conn, "SELECT * FROM `dispensed drugs`") or die('Query failed');



?>

<!DOCTYPE html>
<html>
    <link rel ="stylesheet" href = "style.css">
    <head>
        <title>History</title>
        <h2>
        <header>History</header></h2>
    </head>
    <body>
    <?php if (empty($select)): ?>
        <p>Empty History</p>
    <?php else: ?>
        <table>
            
        <tr>
            <th>Dispenser ID</th>
            <th>Patient ID</th>
            <th>Drugs Dispensed</th>
            <th>Date Dispensed</th>
            </tr>
            
            <?php while ($h = mysqli_fetch_assoc($select)): ?>
    <tr>
        <td><?php echo $h['DD_Id']; ?></td>
        <td><?php echo $h['DD_pt_id']; ?></td>
        <td><?php echo $h['DD_List']; ?></td>
        <td><?php echo $h['DD_Date']; ?></td>
    </tr>
<?php endwhile; ?>

            
            
        </table>
<?php endif; ?>

    </body>


</html>