<?php
// Establish database connection
include 'config.php';
session_start();
// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = md5($_POST["password"]); // Hash the password using MD5

    // Prepare the SQL statement
    $sql = "SELECT * FROM pharmacists WHERE pharm_username = '$username' AND pharm_password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        echo "Login successful!";
        $row = mysqli_fetch_assoc($result);
        $_SESSION['pharm_id'] = $row['pharm_id'];
        header('location:pharmacist.php');
    } else {
        echo "Login failed. Invalid username or password.";
    }
}

// Close the database connection
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pharmacist Login</title>
    <style>
        body {
            background-color: #f5f5f5;
        }
        .login-card {
            background-color: #fff;
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        .login-card h2 {
            text-align: center;
        }
        .login-card label {
            display: block;
            margin-bottom: 5px;
        }
        .login-card input[type="text"],
        .login-card input[type="password"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }
        .login-card button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Pharmacist Login</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
            <button  > <a href="pharm_register.php">Sign up</a> </button>
        </form>
    </div>
</body>
</html>
