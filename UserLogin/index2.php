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

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home Page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./style2.css">
</head>
<body>
   
<?php
if(isset($message)){
   foreach($messages as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>

<div class="container">
<nav class="nav">
   <div class="contain">
   <img src="images/logo.svg" alt="Logo" class="siteLogo">
   <?php
      $select_user = mysqli_query($conn, "SELECT * FROM `user_info` 
      WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
      };
   ?>
   <div class="userInfo">
      <a href="index2.php?logout=<?php echo $user_id; ?>" 
         onclick="return confirm('are your sure you want to logout?');" class="logOut">Log out</a>
      <span><?php echo $fetch_user['name']; ?></span>
   </div>
   </div>
   
</nav>
</body>
</html>