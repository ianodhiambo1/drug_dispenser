<?php
   
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
</head>
<body>
    <h1>list of patients</h1>

    <ol>
    <?php
      $select_user = mysqli_query($conn, "SELECT * FROM `user_info`") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         while($fetch_user = mysqli_fetch_assoc($select_user)){
   ?>
         <?php $id = $fetch_user['id'];
            $fname = $fetch_user['fName'] ;
            $lname = $fetch_user['lName'] ; ?>
         <div class="name"><?php echo "<a href='add_prescription.php?id=$id'>$fname $lname</a>"; ?></div>
    </ol>
    <?php
      };
   };
   ?>
</body>
</html>