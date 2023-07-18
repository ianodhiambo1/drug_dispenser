<?php
   session_start();
   $user_id = $_SESSION['doctor_id'];
   
   if(!isset($user_id)){
      header('location:doctor_login.php');
   };
   
   if(isset($_GET['logout'])){
      unset($user_id);
      session_destroy();
      header('location:doctor_login.php');
   };
   
   include 'config.php';
   if(isset($message)){
    foreach((array)$message as $message){
       echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
    }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel ="styleheat" href="style3.css">
    <style>
        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }
    
        ol {
            list-style-type: decimal;
            padding-left: 20px;
        }
    
        .name {
            margin-bottom: 10px;
        }
    
        .name a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
    
        .name a:hover {
            text-decoration: underline;
        }
        .navbar {
        background-color: grey;
        padding: 10px;
        display: flex;
        justify-content: space-between;
        width: 500px;
        margin: 10px auto;
        border: solid white 1px;
        border-radius: 6px;
    }

    .navbar-brand {

        margin-right: 10px;
        font-weight: bold;
        font-size: 30px;
    }

    .navbar-username {
        margin-right: 10px;
        font-weight: bold;
        font-size: 30px;
    }

    .navbar-logout {
        background-color: #dc3545;
        color: #fff;
        border: none;
        padding: 8px 12px;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
    }
    </style>
</head>
<body>
<?php
      $select_user = mysqli_query($conn, "SELECT * FROM `doctors` 
      WHERE doctor_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
      };
   ?>
<div class="navbar">
    <span class="navbar-brand">Doctor Dashboard</span>
    <a class="navbar-logout" href="doctor.php?logout=<?php echo $user_id; ?>" 
         onclick="return confirm('are your sure you want to logout?');" class="logOut">Log out</a>
      <span class="navbar-username"><?php echo $fetch_user['doctor_username']; ?></span>
</div>

<h1>List of Patients</h1>

<ol>
    <?php
    $select_user = mysqli_query($conn, "SELECT * FROM `user_info`") or die('query failed');
    if (mysqli_num_rows($select_user) > 0) {
        while ($fetch_user = mysqli_fetch_assoc($select_user)) {
            $id = $fetch_user['id'];
            $fname = $fetch_user['fName'];
            $lname = $fetch_user['lName'];
            ?>
            <li class="name"><?php echo "<a href='add_prescription.php?id=$id'>$fname $lname</a>"; ?></li>
            <?php
        }
    }
    ?>
</ol>

</body>

</html>