<?php

$dsn = 'mysql:host=localhost;dbname=patientsd';
$username = 'root';
$password = '';
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

try {

    $pdo = new PDO($dsn, $username, $password, $options);

} catch (PDOException $e) {
 
    echo "Connection failed: " . $e->getMessage();
    exit;

}


$query = "SELECT * FROM patients";
$stmt = $pdo->query($query);
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctors Homepage</title>
</head>
<body>
    <h1>Patients</h1>

    <?php if (empty($patients)): ?>
        <p>No patients found.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient): ?>
                    <tr>
                        <td><?php echo $patient['pt_fname']; ?></td>
                        <td><?php echo $patient['pt_lname']; ?></td>
                        <td><?php echo $patient['pt_age']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>