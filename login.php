<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the username and password from the form submission
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the username and password (you can add more checks here)
    if ($username === 'admin' && $password === 'password') {
        // Redirect to the home page or do any other desired operation
        header('Location: home.php');
        exit();
    } else {
        // Login failed
        echo 'Invalid username or password. Please try again.';
    }
}
?>

<!DOCTYPE html>
<html>
<link rel ="styleheat" href="Style.css">
<body>
<div class="container">
        <h2>Login</h2>
        <form method="post" action="login.php">
            <label for="email">Email</label>
            <input type="text" name="username" id="username" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <input type="submit" value="Login">
            <input type="submit" value="Signup">
        </form>
    </div>
</body>
</html>

