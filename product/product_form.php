<?php
    if (isset($_GET['user_id'])) {
        $userId = $_GET['user_id'];
        // $user_types_id = $_GET['user_types_id'];
        //  echo $userId;
        // echo $user_types_id;
        // Use $userId and $username as needed in your dashboard page
    } else {
        // Handle the case where parameters are not provided
        echo 'Invalid URL';
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Form</title>
    <link rel="stylesheet" href="product_desgin.css">
</head>
<body>
    <div class="form-container">
        <h2>Product Details</h2>
        <form id="productForm">

            <label for="companyId">Company ID:</label>
            <input type="text" id="companyId" name="companyId" value="<?php echo isset($_GET['user_id']) ? htmlspecialchars($_GET['user_id']) : ''; ?>" readonly required>

            <label for="productName">Product Name:</label>
            <input type="text" id="productName" name="productName" required>

            <label for="productQuantity">Product Quantity For WareHouse:</label>
            <input type="number" id="productQuantity" name="productQuantity" required>

            <label for="warehouseName">Warehouse Name:</label>
            <select id="warehouseName" name="warehouseName" required>
                <!-- Warehouse options will be dynamically populated here -->
            </select>

            <label for="storeproductQuantity">Product Quantity For StoreHouse:</label>
            <input type="number" id="storeproductQuantity" name="storeproductQuantity" required>

            <label for="storehouseName">StoreHouse Name:</label>
            <select id="storehouseName" name="storehouseName" required>
                <!-- Warehouse options will be dynamically populated here -->
            </select>

            <button type="submit">Submit</button>
        </form>
    </div>
    <script src="./product_script.js"></script>
</body>
</html>
