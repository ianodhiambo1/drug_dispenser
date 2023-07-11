<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the username and password from the form submission
    $email = $_POST['pt_fname'];
    $password = $_POST['pt_ID'];

    // Validate the username and password (you can add more checks here)
    if ($email === 'admin' && $password === 'password') {
        // Redirect to the home page or do any other desired operation
        header('Location: Doctors Hompage.html');
        exit();
    } else {
        // if the login fails
        echo 'Invalid username or password. Please try again.';
    }
}
?>