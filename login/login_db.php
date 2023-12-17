<?php
session_start();
require_once("../config/db_connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the POST data
    $phoneNumber = $_POST['phone_number'];
    $password = $_POST['password'];



    try {
        // Prepare the SQL statement with placeholders
        $query = $conn->prepare("SELECT * FROM users WHERE phone_number = :phone_number AND password = :password");

        // Bind parameters to placeholders
        $query->bindParam(':phone_number', $phoneNumber);
        $query->bindParam(':password', $password);

        // Execute the prepared statement
        $query->execute();

        // Fetch the result
        $user = $query->fetch(PDO::FETCH_ASSOC);



        if ($user) {

            //set session, cookie for 1 hour

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_authenticated'] = true;
            setcookie('user_id', $user['id'], time() + 3600, '/', '', true, true);

            // User found, perform login actions
            echo json_encode(['success' => true, 'message' => 'Login successful','user'=>$user]);
        } else {
            // User not found or invalid credentials
            echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
