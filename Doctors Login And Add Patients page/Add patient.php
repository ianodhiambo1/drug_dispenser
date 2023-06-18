<?php
// Retrieve form data
$firstname = $_POST['firstname'];
$secondname = $_POST['secondname'];
$Dob = $_POST['Dob'];

// Validate form data (you can add more validation if needed)
if (empty($firstname) || empty($secondname) || empty($Dob)) {
    echo "Please fill in all the fields.";
    exit;
}

// Create a new PDO instance (adjust the database credentials as necessary)
$dsn = 'mysql:host=localhost;dbname=patients';
$username = 'your_username';
$password = 'your_password';
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Prepare and execute the SQL query
$query = "INSERT INTO patients (firstname, secondname, Dob) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($query);
$stmt->execute([$firstname, $secondname, $Dob]);

// Check if the insertion was successful
if ($stmt->rowCount()) {
    echo "Patient added successfully.";
} else {
    echo "An error occurred while adding the patient.";
}
?>