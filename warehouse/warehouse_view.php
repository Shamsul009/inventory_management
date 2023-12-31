<?php

    require_once('../session/session_check.php');
    checkSession();
    
    if (isset($_GET['user_id'])) {
        $userId = $_GET['user_id'];
        $user_types_id = $_GET['user_types_id'];
    } else {
        echo 'Invalid URL';
        exit;
    }

    require_once("../config/db_connect.php");
    try {
        // Fetch the warehouses based on company_id from the database
        $query = $conn->prepare("SELECT name, id,company_id FROM users WHERE company_id = (SELECT company_id FROM users WHERE id = :user_id) AND user_types_id = 2");

        // Bind the parameter
        $query->bindParam(':user_id', $userId);

        // Execute the query
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($results)) {
            $companyID = $results[0]['company_id'];
        } else {
            // Handle the case where no results are found
            $companyID = ''; //  Set a default value or handle it as needed
        }

        // Separate the results based on user_types_id
        // $warehouses = [];
        $storehouses = [];

        foreach ($results as $result) {
            $storehouses[] = $result;
            
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    // echo '<script>const userId = ' . $userId . '; const user_types_id = ' . $user_types_id . ';</script>';


?>



<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./warehouse_desgin.css">
    <title>WareHouse Page</title>
</head>

<body>

    
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-3 sidenav hidden-xs">
            <img src="../assets/logo (2).png" alt="Logo" width="220" height="50">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="#section1" onclick="changeActiveState(this)">Dashboard</a></li>
                    <li><a href="#" onclick="changeActiveState(this); checkUserTypeAndRedirect(<?php echo $user_types_id; ?>, <?php echo $userId; ?>, 3, event);">WareHouse Details</a></li>
                    <li><a href="#" onclick="changeActiveState(this);">StoreHouse List</a></li>
                    <li><a href="#" onclick="changeActiveState(this); checkUserTypeAndRedirect(<?php echo $user_types_id; ?>, <?php echo $userId; ?>, 1, event);">Product Create</a></li>
                    <li><a href="../logout/logout_page.php" onclick="changeActiveState(this);">Logout</a></li>
                </ul>
                
            </div>

            <div class="col-sm-9">
                <table data-user-id="<?php echo $userId; ?>">
                        <tr>
                            <th>Product Name</th>
                            <th>Product Quantity</th>
                            <!-- <th>Warehouse Name</th> -->
                            <th>Actions</th>
                        </tr>
                    
                    <tbody id="productsTableBody">
                        <!-- Product data will be dynamically populated here -->
                    </tbody>
                </table>
            </div>

            <div class="col-sm-12">
                
                <form id="updateForm" style="display: none;">

                    <input type="hidden" id="productId" name="productId">
                    
                    <label for="updatedProductName">Delivery Product Quantity:</label>
                    <input type="number" id="deliveryProductQuantity" name="deliveryProductQuantity" required>
                    <br>
                    <label for="storehouseName">StoreHouse Name:</label>
                        <select id="storehouseName" name="storehouseName" required>
                                <?php foreach ($storehouses as $storehouse) : ?>
                                    <option value="<?= htmlspecialchars($storehouse['name']); ?>">
                                        <?= htmlspecialchars($storehouse['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                        </select>
                    
                    <br>
                    <label for="warehouseID">WareHouse Id:</label>
                    <input type="number" id="warehouseID" name="warehouseID" value="<?php echo isset($_GET['user_id']) ? htmlspecialchars($_GET['user_id']) : ''; ?>" readonly required>

                    <br>
                    <label for="companyID">Company Id:</label>
                    <input type="number" id="companyID" name="companyID" value="<?php echo $companyID; ?>" required>
                    

                    <button type="button" onclick="submitUpdateForm()">Delivery</button>
                </form>

            </div>


        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../authentication/authentication_module.js"></script>
    <script type="text/javascript" src="../warehouse/warehouse_script.js"></script>
    <script type="text/javascript" src="../sidebar/sidebar_state.js"></script>

</body>

</html>