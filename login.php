<?php

include 'connect.php';
session_start();

if(isset($_POST['submit'])){

$email = $_POST['email'];
$password = $_POST['password'];

// Prepare and bind the SQL statement
$stmt = $conn->prepare("SELECT * FROM user_info WHERE email = '$email' and password = 'password' ");
$stmt->bind_param("s", $email);

// Execute the prepared statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if the user exists
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $storedPassword = $row['password'];

    // Verify the password
    if (password_verify($password, $storedPassword)) {
        // Password is correct, perform login actions
        echo "Login successful!";
        header('location:Doctors.php');
    } else {
        // Invalid password
        echo "Invalid password";
    }
} else {
    // User does not exist
    echo "User not found";
    
}



// Close the statement and database connection
$stmt->close();
$conn->close();

}
?>

<!DOCTYPE html>
<html>

<body>

<link rel ="stylesheet" href="style.css">
<div class="container">
        <h2>Login</h2>
        <form method="post" action="login.php">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" required>
            <label for="password">Password</label>
            <input type="text" name="password" id="password" required>
            <input type="submit" value="Login">
            
        </form>
        Dont have a login? Sign up <a href = "signup.php">here</a>

    </div>
</body>
</html>

