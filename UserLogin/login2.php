<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $Uname = mysqli_real_escape_string($conn, $_POST['Uname']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `user_info` WHERE 
   name = '$Uname' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:index2.php');
   }else{
      $messages[] = 'incorrect password or email!';
   }

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
    <h2>Login Page</h2><br>
    <div class="page">
    <?php
    if(isset($message)){
        foreach($messages as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
        }
     }
    ?>
    <form id="login" method="post" action="login2.php">
        <label><b>User Name
        </b>
        </label>
        <input type="text" name="Uname" id="Uname" placeholder="Username" required>
        <br><br>
        <label><b>Password
        </b>
        </label>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <br><br>
      
        <input type="submit" name="submit" id="log" value="Log In">
        <button class="btn"><a href="register2.php">Sign Up</a></button>
        <br><br>
        <input type="checkbox" id="check">
        <span>Remember me</span>
        <br><br>
        <a class="forgot" href="#">Forgot Password?</a>
        <br>
    </form>
</div>
</body>
</html>