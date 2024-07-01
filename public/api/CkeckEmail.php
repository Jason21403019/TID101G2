<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("conn.php");


$email = isset($_POST['email']) ? $_POST['email'] : '';

echo $email;

// Log the received email
error_log("Received email: " . $email);

if ($email) {
    $stmt = $conn->prepare('SELECT * FROM member WHERE email = "da@gmail.com"');
    $stmt->execute([$email]);
    $exists = $stmt->fetchAll() > 0;
    
    // Log the result of the query
    echo 'ddd';
    error_log("Email exists: " . ($exists ? 'true' : 'false'));
    
    echo json_encode(['exists' => $exists]);
} else {
    echo json_encode(['exists' => false]);
}



?>