    <?php
    include 'config.php';

    if (isset($_GET['id'])) {
        $userId = $_GET['id'];
    } 
       if(isset($_POST['submit']) ){
        global $userId;
        $pr_name= mysqli_real_escape_string($conn, $_POST['name']);
        $pr_diagnosis = mysqli_real_escape_string($conn, $_POST['Diagnosis']);
        $selectedDrugs = $_POST['selected_drugs'];
        $selectedDrugsString = implode(',', $selectedDrugs);

        $pr_AdditonalInfo = mysqli_real_escape_string($conn, $_POST['AdditionalInfo']);
        $pr_date_written= date('Y-m-d');
        $sql = "INSERT INTO `prescription`(pr_name, pr_diagnosis, pr_ListOdrugs, pr_AdditonalInfo, patient_id, pr_date_written) VALUES('$pr_name', '$pr_diagnosis', '$selectedDrugsString', '$pr_AdditonalInfo', '$userId', '$pr_date_written')";
        if (mysqli_query($conn, $sql)) {
            $prescriptionId = mysqli_insert_id($conn);
            
            // Prescription added successfully, now process the selected drugs
            foreach ($selectedDrugs as $drugId) {
                // Prepare the SQL statement to insert the drug prescription into the database
                $sqlDrug = "INSERT INTO PrescriptionDrugs (prescription_id, drug_id) VALUES ('$prescriptionId', '$drugId')";
                mysqli_query($conn, $sqlDrug);
            }

            // Redirect to a success page
            echo "<script>alert('Prescription submitted successfully!')</script>";
            header("Location: doctor.php");
            exit();
        } else {
            // Error occurred, redirect to an error page
            header("Location: error.php");
            exit();
        }
        
    
}
        ?>

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
        if(isset($message)){
           foreach((array)$message as $message){
              echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
           }
        }
    ?>
    <form id="diagnosis" method="post" action="add_prescription.php?id=<?php echo $userId; ?>">
        <label><b>Name
            </b><br>
        </label>
        <input type="text" name="name" id="pr_name" value="Dr Mabonga" required>
        <br><br>
        <label><b>Diagnosis
            </b><br>
        </label>
        <textarea name="Diagnosis" id="Diagnosis" required></textarea>  
        <br><br>
        <label><b>List Of Drugs:</b><br></label>
        <div id="drug_list"></div>
        <br><br>
        <label><b>Additional Info
            </b><br>
        </label>
        <textarea name="AdditionalInfo" id="AdditionalInfo" required></textarea>
        <br><br>
        <input style="width: 200px;" type="submit" name="submit" id="log" value="Submit to Patient">
        <br><br>
    </form>
</div>

<script>

    // Wait for the DOM to be ready
document.addEventListener('DOMContentLoaded', function() {
  // Get the drug list container element
  const drugListContainer = document.getElementById('drug_list');

  // Perform AJAX request to retrieve drug list
  // Replace the AJAX URL with your actual server-side endpoint
  const ajaxURL = 'get_drug_list.php';
  const xhr = new XMLHttpRequest();

  xhr.open('GET', ajaxURL, true);

  xhr.onload = function() {
    if (xhr.status === 200) {
      // Parse the JSON response
      const response = JSON.parse(xhr.responseText);

      // Populate the drug list
      if (response.length > 0) {
        response.forEach(function(drug) {
          addDrugCheckbox(drug);
        });
      }
    }
  };

  xhr.send();

  // Function to add a drug checkbox to the list
  function addDrugCheckbox(drug) {
    const checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.name = 'selected_drugs[]';
    checkbox.value = drug.id;

    const label = document.createElement('label');
    label.textContent = drug.name;

    const drugListItem = document.createElement('div');
    drugListItem.appendChild(checkbox);
    drugListItem.appendChild(label);

    drugListContainer.appendChild(drugListItem);
  }
});

</script>

</body>
</html>