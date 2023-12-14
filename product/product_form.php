<?php
    if (isset($_GET['user_id'])) {
        $userId = $_GET['user_id'];
    } else {
        echo 'Invalid URL';
    }

    require_once("../config/db_connect.php");
    try {
        // Fetch the warehouses based on company_id from the database
        $query = $conn->prepare("SELECT name, user_types_id FROM users WHERE company_id = $userId AND user_types_id IN (2, 3)");
        // $query->bindParam(':company_id', $company_id);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        // Separate the results based on user_types_id
        $warehouses = [];
        $storehouses = [];

        foreach ($results as $result) {
            if ($result['user_types_id'] == 3) {
                $warehouses[] = $result;
            } elseif ($result['user_types_id'] == 2) {
                $storehouses[] = $result;
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
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

            <label for="productTotal">Total Product:</label>
            <input type="number" id="productTotal" name="productTotal" required>

            <label for="productQuantity">Product Quantity For WareHouse:</label>
            <input type="number" id="productQuantity" name="productQuantity" required>

            <label for="warehouseName">Warehouse Name:</label>
            <select id="warehouseName" name="warehouseName" required>
                    <?php foreach ($warehouses as $warehouse) : ?>
                        <option value="<?= htmlspecialchars($warehouse['name']); ?>">
                            <?= htmlspecialchars($warehouse['name']); ?>
                        </option>
                    <?php endforeach; ?>
            </select>

            <label for="storeproductQuantity">Product Quantity For StoreHouse:</label>
            <input type="number" id="storeproductQuantity" name="storeproductQuantity" required>

            <label for="storehouseName">StoreHouse Name:</label>
            <select id="storehouseName" name="storehouseName" required>
                    <?php foreach ($storehouses as $storehouse) : ?>
                        <option value="<?= htmlspecialchars($storehouse['name']); ?>">
                            <?= htmlspecialchars($storehouse['name']); ?>
                        </option>
                    <?php endforeach; ?>
            </select>

            <button type="submit">Submit</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./product_script.js"></script>
</body>
</html>
