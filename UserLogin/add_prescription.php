
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Prescription</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

   <h2>Prescription Editor</h2>
    <div class="diagnosis">
    <?php
    include 'config.php';

    
    if (isset($_GET['id'])) {
        $id=$_GET['id'];
        
        // Retrieve drug information based on the provided dr_id
        $query = "SELECT * FROM `user_info` WHERE id = $id";
        $result = mysqli_query($conn, $query);
        
        // Display drug information
        if ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='patient-name'><span class='title'>{$row['fName']} {$row['lName']} {$row['id']}</span> </div>";
        } else {
            echo "User not found.";
        }
    } else {
        echo "No user selected.";
    }
    ?>
    <form id="diagnosis" method="post" action="add_prescription.php">
        <label><b>Name
            </b><br>
        </label>
        <input type="text" name="name" id="pr_name" required>
        <br><br>
        <label><b>Diagnosis
            </b><br>
        </label>
        <input type="text" name="Diagnosis" id="Diagnosis" required>
        <br><br>
        <label><b>List Of Drugs
            </b><br>
        </label>
        <input type="text" name="listODrugs" id="listODrugs" required>
        <br><br>
        <label><b>Additional Info
            </b><br>
        </label>
        <input type="text" name="AdditionalInfo" id="AdditionalInfo" required>
        <br><br>
        <input style="width: 200px;" type="submit" name="submit" id="log" value="Submit to Patient">
        <br><br>
    </form>
</div>

</body>
</html>
<?php
if(isset($_POST['submit'])){
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $pr_name= mysqli_real_escape_string($conn, $_POST['name']);
        $pr_diagnosis = mysqli_real_escape_string($conn, $_POST['Diagnosis']);
        $pr_ListOdrugs = mysqli_real_escape_string($conn, $_POST['listODrugs']);
        $pr_AdditonalInfo = mysqli_real_escape_string($conn, $_POST['AdditionalInfo']);
        $pr_date_written= date('Y-m-d');
    
        $select = mysqli_query($conn, "SELECT * FROM `prescription`");
        $sql = "INSERT INTO `prescription`(pr_name, pr_diagnosis, pr_ListOdrugs, pr_AdditonalInfo, patient_id, pr_date_written) VALUES('$pr_name', '$pr_diagnosis', '$pr_ListOdrugs', '$pr_AdditonalInfo', '$id', '$pr_date_written')";
    
    
        if (mysqli_query($conn, $sql)) {
            $message="Prescription succesfully added";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Check if the dr_id parameter exists in the URL\
    echo $id;

    }
    ?>