<?php
require_once("../config/db_connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a database connection established
    
    // Get data from the AJAX request
    $company_id = $_POST['company_id'];
    $productName = $_POST['productName'];
    $productQuantity = $_POST['productQuantity'];
    $warehouseName = $_POST['warehouseName'];
    $storeproductQuantity = $_POST['storeproductQuantity'];
    $storehouseName = $_POST['storehouseName'];
    $productTotal= $_POST['productTotal'];

    try {
        // Insert data into the database
        $query = $conn->prepare("INSERT INTO products (company_id, product_name, house_product_quantity, warehouse_name, store_product_quantity, store_name,total_product) VALUES (:company_id, :productName, :productQuantity, :warehouseName, :storeproductQuantity, :storehouseName,:productTotal)");

        $query->bindParam(':company_id', $company_id);
        $query->bindParam(':productName', $productName);
        $query->bindParam(':productQuantity', $productQuantity);
        $query->bindParam(':warehouseName', $warehouseName);
        $query->bindParam(':storeproductQuantity', $storeproductQuantity);
        $query->bindParam(':storehouseName', $storehouseName);
        $query->bindParam(':productTotal', $productTotal);
        $query->execute();
        // After the execute statement
        // echo "Rows affected: " . $query->rowCount(); // Check the number of affected rows


        // Respond with a success message or any other relevant data
        echo json_encode(['success' => true, 'message' => 'Product inserted successfully']);
    } catch (PDOException $e) {
        // Handle the exception, log the error, or respond with an error message
        echo json_encode(['success' => false, 'message' => 'Error inserting product: ' . $e->getMessage()]);
    }
} else {
    // Handle cases where the request method is not POST
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
