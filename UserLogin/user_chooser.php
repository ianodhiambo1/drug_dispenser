<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
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

        .container a {
            display: block;
            margin-bottom: 10px;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            text-align: center;
            border-radius: 4px;
        }

        .container a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login Page</h2>
        <a href="login2.php">Login as Patient</a>
        <a href="doctor_login.php">Login as Doctor</a>
        <a href="pharm_login.php">Login as Pharmacist</a>
        <a href="admin_login.php">Login as Admin</a>
    </div>
</body>
</html>
