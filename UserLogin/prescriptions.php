



<?php
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
    $select= mysqli_query($conn,"SELECT * FROM `prescription` WHERE patient_id ='$user_id'") or die('query failed');
    




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
<nav class="nav">
   <div class="contain">
   <a href="index2.php"><img src="images/logo.svg" alt="Logo" class="siteLogo"></a>

   <?php
      $select_user = mysqli_query($conn, "SELECT * FROM `user_info` 
      WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
          $fetch_user = mysqli_fetch_assoc($select_user);
        };
        ?>
   <div class="userInfo">
      <a href="shop.php"><button>Shop</button></a>
      <a href="prescriptions.php"><button>Your Prescriptions</button></a>
      <a href="index2.php?logout=<?php echo $user_id; ?>" 
         onclick="return confirm('are your sure you want to logout?');" class="logOut">Log out</a>
      <span><?php echo $fetch_user['name']; ?></span>
   </div>
   </div>
   
</nav>

        <?php
        if(isset($message)){
           foreach((array)$message as $message){
              echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
           }
        }
        ?>
    <div class="prescription-table">
        <h2>Dr Mabonga</h2>
        <?php
        if(mysqli_num_rows($select)>0){
            while($fetch_presc = mysqli_fetch_assoc($select)){
        ?>
        <div class="diagnosis-box boxP">
            <span class="title">Diagnosis</span>
            <p><?php echo $fetch_presc['pr_diagnosis']; ?></p>
        </div>
        <div class="prescription-box boxP">
        <span class="title">Prescription</span>
            <p><?php echo $fetch_presc['pr_AdditonalInfo']; ?></p>
        </div>
        <div class="listODrugs-box boxP">
        <span class="title">List Of Drugs</span>
            <p><?php echo $fetch_presc['pr_ListOdrugs']; ?></p>
        </div>
        <div class="listODrugs-box boxP">
        <span class="title">Date</span>
            <p><?php echo $fetch_presc['pr_date_written']; ?>.</p>
        </div>
        <a href="shop.php"><button class="shop-button" >Go to Shop</button></a>
    </div>
    <?php
            }}
    
    ?>



</body>
</html>