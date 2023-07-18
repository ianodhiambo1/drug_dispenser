<?php

include "config.php";

$select = mysqli_query($conn, "SELECT * FROM `dispensed_drugs`") or die('Query failed');



?>

<!DOCTYPE html>
<html>
    <link rel ="stylesheet" href = "style3.css">
    <head>
        <title>History</title>
        
        <header style="height:50px;">
            <h1>
            History
</h1>

            <div>
            <button onclick="window.location.href='pharmacist.php'">Home</button>
            <button onclick="window.location.href='login.php'">Log out</button>
            <button onclick="window.location.href='Dispense.php'">Dispenser</button>
        </div>
        </header>
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
        <td><?php echo $h['DD_id']; ?></td>
        <td><?php echo $h['DD_pt_id']; ?></td>
        <td><?php echo $h['DD_List']; ?></td>
        <td><?php echo $h['DD_Date']; ?></td>
    </tr>
<?php endwhile; ?>

            
            
        </table>
<?php endif; ?>

    </body>


</html>