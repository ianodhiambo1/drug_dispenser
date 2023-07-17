<?php
// Establish database connection
include 'config.php';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $address = $_POST["address"];

    // Prepare the SQL statement
    $sql = "INSERT INTO Pharmacists (pharm_username, pharm_password, pharm_full_name, pharm_email, pharm_address)
            VALUES ('$username', '$password', '$fullname', '$email', '$address')";

    if (mysqli_query($conn, $sql)) {
        echo "Registration successful!";
        header('location:pharm_login.php');

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pharmacist Registration</title>
    <style>
        body {
            background-color: #f5f5f5;
        }
        .register-card {
            background-color: #fff;
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        .register-card h2 {
            text-align: center;
        }
        .register-card label {
            display: block;
            margin-bottom: 5px;
        }
        .register-card input[type="text"],
        .register-card input[type="password"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }
        .register-card button {
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
    <div class="register-card">
        <h2>Pharmacist Registration</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address">
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
