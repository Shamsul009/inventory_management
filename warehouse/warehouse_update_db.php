<?php
require_once("../config/db_connect.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $productId = $_POST['productId'];
    $deliveryProductQuantity = $_POST['deliveryProductQuantity'];
    $storehouseName = $_POST['storehouseName'];
    $warehouseID = $_POST['warehouseID'];
    $companyID = $_POST['companyID'];

    // $productId = 1;
    // $deliveryProductQuantity = 5;
    // $storehouseName = 'StoreHouse1' ;
    // $warehouseID = 3;
    // $companyID = 1;

    try {
        // Insert data into the database
        $query = $conn->prepare("INSERT INTO warehouse_delivery (product_id, product_quantity, store_house, warehouse_id, company_id) VALUES (:productId, :deliveryProductQuantity, :storehouseName, :warehouseID, :companyID)");

        $query->bindParam(':productId', $productId);
        $query->bindParam(':deliveryProductQuantity', $deliveryProductQuantity);
        $query->bindParam(':storehouseName', $storehouseName);
        $query->bindParam(':warehouseID', $warehouseID);
        $query->bindParam(':companyID', $companyID);
        $query->execute();

        // if($query->execute()){
        //     echo "first part";
        // }

        $query_products_table = $conn->prepare("
        SELECT house_product_quantity, store_name, store_product_quantity
        FROM products
        WHERE warehouse_name = (SELECT name FROM users WHERE id = $warehouseID)
            AND company_id = $companyID
            AND product_id = $productId
        ");

        if ($query_products_table->execute()) {
            // Fetch the result
            $result_products_table = $query_products_table->fetch(PDO::FETCH_ASSOC);

           
        
            if ($result_products_table !== false) {
                // The fetch was successful, now you can access the values
                // echo $result_products_table['house_product_quantity'];
        
                $newHouseProductQuantity = $result_products_table['house_product_quantity'] - $deliveryProductQuantity;
                $newStoreQuantity = $result_products_table['store_product_quantity'] + $deliveryProductQuantity;
                $storeHouse = $result_products_table['store_name'];
        
                // Output for verification
                // echo "Store Name: $storeHouse<br>";
                // echo "New House Product Quantity: $newHouseProductQuantity<br>";
                // echo "New Store Quantity: $newStoreQuantity<br>";
            } else {
                // No result found
                // echo "No result found";
            }
        } else {
            // Fetch failed
            // echo "Fetch failed";
        }

      

        

        
        
        $updateQuery = $conn->prepare("
        UPDATE products
        SET house_product_quantity = :newHouseProductQuantity,
            store_product_quantity = :newStoreQuantity
        WHERE product_id = :productId AND store_name= :storeHouse AND company_id= :companyId AND warehouse_name = (SELECT name FROM users WHERE id = :warehouseID)
        ");

        $updateQuery->bindParam(':newHouseProductQuantity', $newHouseProductQuantity);
        $updateQuery->bindParam(':storeHouse', $storeHouse);
        $updateQuery->bindParam(':newStoreQuantity', $newStoreQuantity);
        $updateQuery->bindParam(':productId', $productId);
        $updateQuery->bindParam(':warehouseID', $warehouseID);
        $updateQuery->bindParam(':companyId', $companyID);
        $updateQuery->execute();

        // if($updateQuery->execute()){
        //     echo "Third";
        // }




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
