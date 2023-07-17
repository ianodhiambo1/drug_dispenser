<!DOCTYPE html>
<html>
<head>
    <title>Admin Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .container {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .container form {
            display: flex;
            flex-direction: column;
        }

        .container label {
            margin-bottom: 10px;
            font-weight: bold;
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

        .login-link {
            text-align: center;
            margin-top: 10px;
        }

        .login-link a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php
    // Database connection
    include('config.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the submitted values
        $username = $_POST["username"];
        $password = $_POST["password"];
        $fullName = $_POST["fullName"];

        // Prepare and execute the query
        $query = "INSERT INTO admins (admin_username, admin_password, admin_full_name) VALUES ('$username', '$password', '$fullName')";

        if (mysqli_query($conn, $query)) {
            echo "Registration successful. You can now log in as an admin.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
    ?>

    <div class="container">
        <h2>Admin Registration</h2>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" required>

            <input type="submit" value="Register">

            <div class="login-link">
                <a href="admin_login.php">Login</a>
            </div>
        </form>
    </div>
</body>
</html>

