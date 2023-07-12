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

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_quantity = $_POST['product_quantity'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity')") or die('query failed');
      $message[] = 'product added to cart!';
   }

};

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = 'cart quantity updated successfully!';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   header('location:shop.php');
}
  
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:shop.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   

<div class="container">
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

<div class="products">

   <h1 class="heading">Latest Products</h1>

   <div class="box-container">

   <?php
      $select_product = mysqli_query($conn, "SELECT * FROM `drug_info`") or die('query failed');
      if(mysqli_num_rows($select_product) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_product)){
   ?>
      <form method="post" class="box" action="">
         <?php $drId = $fetch_product['dr_id'];
            $drName = $fetch_product['dr_name']; ?>
         <div class="name"><?php echo "<a href='drug_details.php?dr_id=$drId'>$drName</a>"; ?></div>
         <div class="description"><p>Symptoms:<br><?php echo $fetch_product['dr_symptoms']; ?></p></div>
         <div class="price" >$<?php echo $fetch_product['dr_price']; ?>/-</div>
         <div class="card-btn">
         <input type="number" min="1" name="product_quantity" value="1">
         <input type="hidden" name="product_name" value="<?php echo $fetch_product['dr_name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_product['dr_price']; ?>">
         <input type="submit" value="add to cart" name="add_to_cart" class="add-btn">
      </div>
      </form>
   <?php
      };
   };
   ?>

   </div>

</div>

<div class="shopping-cart">

   <h1 class="heading">Shopping cart</h1>

   <table class="styled-table" >
      <thead>
         <th>#</th>
         <th>name</th>
         <th>price</th>
         <th>quantity</th>
         <th>total price</th>
         <th>action</th>
      </thead>
      <tbody>
      <?php
         $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         $grand_total = 0;
         $number=0;
         if(mysqli_num_rows($cart_query) > 0){
            while($fetch_cart = mysqli_fetch_assoc($cart_query)){
      ?>
         <tr>
            <td><?php echo $number++  ?></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td>$<?php echo $fetch_cart['price']; ?>/-</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                  <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                  <input type="submit" name="update_cart" value="update" class="option-btn">
               </form>
            </td>
            <td>$<?php echo $sub_total = (((int)$fetch_cart['price']) * (int)$fetch_cart['quantity']); ?>/-</td>
            <td><a href="shop.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('remove item from cart?');">remove</a></td>
         </tr>
      <?php
         $grand_total += $sub_total;
            }
         }else{
            echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no item added</td></tr>';
         }
      ?>
      <tr class="table-bottom">
         <td colspan="4">grand total :</td>
         <td>$<?php echo $grand_total; ?>/-</td>
         <td><a href="shop.php?delete_all" onclick="return confirm('delete all from cart?');" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">delete all</a></td>
      </tr>
   </tbody>
   </table>

   <div class="cart-btn">  
      <a href="#" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
   </div>

</div>

</div>

</body>
</html>