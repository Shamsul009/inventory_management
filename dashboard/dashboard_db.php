<?php
// Include your database connection code here
require_once("../config/db_connect.php");

// Check if the user_id parameter is set
if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    // echo $userId;

    try {
        // Prepare a SQL statement to fetch data based on user_id
        $stmt = $conn->prepare("SELECT product_name, house_product_quantity, warehouse_name, store_product_quantity, store_name,total_product FROM products WHERE company_id = :user_id");

        // Bind the parameter
        $stmt->bindParam(':user_id', $userId);

        // Execute the query
        $stmt->execute();

        // Fetch the results as an associative array
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the data as JSON
        echo json_encode(['success' => true, 'products' => $products]);
    } catch (PDOException $e) {
        // Handle errors
        echo json_encode(['success' => false, 'message' => 'Error fetching data']);
    }
} else {
    // Handle the case where user_id is not set
    echo json_encode(['success' => false, 'message' => 'user_id parameter not provided']);
}
?>
