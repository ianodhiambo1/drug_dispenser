<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            margin-bottom: 20px;
        }

        .container {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .container h2 {
            text-align: center;
        }

        .container form {
            display: flex;
            flex-direction: column;
        }

        .container label {
            margin-bottom: 10px;
        }

        .container input[type="text"],
        .container input[type="password"] {
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .container input[type="submit"] {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button{
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            padding: 8px 16px;
            border-radius: 4px;
            width : 400px;
            text-decoration: none;
            margin-top: 5px;
        }
        a{
            
            text-decoration: none;
            color: white;
        }
    </style>


</head>
<body>
<?php
// Database connection
include('config.php');
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted values
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare and execute the query
    $query = "SELECT * FROM admins WHERE admin_username='$username' AND admin_password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Authentication successful, redirect to admin dashboard or desired page
        $row = mysqli_fetch_assoc($result);
        $_SESSION['admin_id'] = $row['admin_id'];
        header("Location: admin_home.php");
        exit;
    } else {
        // Authentication failed
        $error_message = "Invalid username or password";
    }
}

mysqli_close($conn);
?>

<div class="container">
    <h2>Admin Login</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Login">
    </form>
    <button>
        <a href="admin_register.php">Register</a>
    </button>

    <?php
    if (isset($error_message)) {
        echo "<p>$error_message</p>";
    }
    ?>
</div>

</body>
</html>
