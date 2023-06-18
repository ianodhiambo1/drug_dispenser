<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the username and password from the form submission
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the username and password (you can add more checks here)
    if ($username === 'admin' && $password === 'password') {
        // Redirect to the home page or do any other desired operation
        header('Location: Doctors Hompage');
        exit();
    } else {
        // Login failed
        echo 'Invalid username or password. Please try again.';
    }
}
?>