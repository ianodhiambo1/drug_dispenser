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
    </style>
</head>
<body>

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