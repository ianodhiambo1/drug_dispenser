<!DOCTYPE html>
<html>
<head>
    <title>Doctor Registration</title>
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
    $speciality = $_POST["speciality"];
    $email = $_POST["email"];

    // Prepare and execute the query
    $query = "INSERT INTO doctors (doctor_username, doctor_password, doctor_full_name, doctor_email, doctor_specialty) VALUES ('$username', '$password', '$fullName', '$email', '$speciality')";

    if (mysqli_query($conn, $query)) {
        echo "Registration successful. You can now log in as an Doctor.";
        header("Location: doctor_login.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<div class="container">
    <h2>Doctor Registration</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="fullName" required>
        <label for="fullName">Email:</label>
        <input type="text" id="email" name="email" required>
        <label for="fullName">Speciality:</label>
        <input type="text" id="fullName" name="speciality" required>

        <input type="submit" value="Register">
    </form>
</div>

</body>
</html>
