<?php
$host = 'localhost';
$dbname = 'inventory_db';
$user = 'root';
$password = "";

try {
    // Establishing a connection to my database using PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

    // echo "Connected successfully";
    // return $conn;
} catch (PDOException $e) {
    //If failed to set a connection
    echo "Connection failed: " . $e->getMessage();
}
?>
