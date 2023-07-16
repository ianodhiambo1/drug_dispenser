<?php

include 'connect.php';
session start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['Uname']);
   $Fname = mysqli_real_escape_string($conn, $_POST['Fname']);
   $Lname = mysqli_real_escape_string($conn, $_POST['Lname']);
   $dob = $_POST['dob'];
// Calculate the age based on the date of birth
    $currentDate = date('Y-m-d');
    $age = date_diff(date_create($dob), date_create($currentDate))->y;
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `user_info` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $messages[] = 'user already exists!';
   }else{
      mysqli_query($conn, "INSERT INTO `user_info`(name, email, password,fName,lName,age,address) VALUES('$name', '$email', '$pass','$Fname','$Lname','$age','$address')") or die('query failed');
      $messages[] = 'registered successfully!';
      header('location:login.php');
   }

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up Form</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
    <h2>Sign Up Page</h2><br>
    <div class="page">
    <?php
    if(isset($message)){
        foreach($messages as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
        }
     }
    ?>
    <form id="login" method="post" action="signup.php">
        <label><b>User Name
        </b>
        </label>
        <input type="text" name="Uname" id="Uname" placeholder="Username" required>
        <br><br>
        <label><b>First Name
        </b>
        </label>
        <input type="text" name="Fname" id="Uname" placeholder="First Name" required>
        <br><br>
        <label><b>Last Name
        </b>
        </label>
        <input type="text" name="Lname" id="Uname" placeholder="Last Name" required>
        <br><br>
        <label><b>Date Of Birth
        </b><br>
        </label>
        <input type="date" name="dob" required>
        <br><br>
        <label><b>Address
        </b>
        </label>
        <input type="text" name="address" id="Uname" placeholder="Address" required>
        <br><br>
        <label><b>Email
        </b><br>
        </label>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <br><br>
        <label><b>Password
        </b>
        </label>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <br><br>
        <input style="width: 300px;" type="submit" name="submit" id="log" value="Sign Up">
        <br><br>
        <span href="#">Already have an account? <a class="forgot" style="float: none;" href="login.php">Login</a></span>
        <br>
    </form>
</div>
</body>
</html>