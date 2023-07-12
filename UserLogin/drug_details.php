<!DOCTYPE html>
<html>
<head>
    <title>Drug Details</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="nav">
   <div class="contain">
   <a href="index2.php"><img src="images/logo.svg" alt="Logo" class="siteLogo"></a>

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


    

    

    <?php


    // Check if the dr_id parameter exists in the URL
    if (isset($_GET['dr_id'])) {
        $drId = $_GET['dr_id'];

        // Retrieve drug information based on the provided dr_id
        $query = "SELECT * FROM drug_info WHERE dr_id = $drId";
        $result = mysqli_query($conn, $query);

        // Display drug information
        if ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='details'>";
            echo "<h1 style='margin-left:1.5em;'>Drug Details</h1>";
            echo "<div class='name-details'><span class='title'>{$row['dr_name']}</span> </div>";
            echo "<div class='pharm-company'><span class='title'>Pharmaceutical Company:</span> {$row['dr_pharmCompany']}</div>";
            echo "<div class='descript'><span class='title'>Description:</span> {$row['dr_description']}</div>";
            echo "<div class='price-details'><span class='title'>Price:</span> {$row['dr_price']}</div>";
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
