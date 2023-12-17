<?php
    if (isset($_GET['user_id'])) {
        $userId = $_GET['user_id'];
        $user_types_id = $_GET['user_types_id'];
        
    } else {
        // Handle the case where parameters are not provided
        echo 'Invalid URL';
    }

    
?>



<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../authentication/authentication_module.js"></script>
   
    <link rel="stylesheet" href="./dashboard_desgin.css">
    <title>Dashboard Page</title>
</head>

<body>

    
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-3 sidenav hidden-xs">
                <h2>Logo</h2>
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#section1">Dashboard</a></li>
                    <li><a href="#" onclick="checkUserTypeAndRedirect(<?php echo $user_types_id; ?>, <?php echo $userId; ?>,auth=3,event);">WareHouse Details</a></li>
                    <li><a href="#">StoreHouse List</a></li>
                    <li><a href="#" onclick="checkUserTypeAndRedirect(<?php echo $user_types_id; ?>, <?php echo $userId; ?>, auth=1,event);">Product Create</a></li>  
                    <li><a href="../login/login_view.php">Logout</a></li>
                </ul>
            </div>
            <br>

            <div class="col-sm-9">
                <div class="well">
                    <h4>Dashboard</h4>
                    <p>Some text..</p>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>WareHouse</h4>
                            <p>1 Million</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>Store</h4>
                            <p>100 Million</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>Sessions</h4>
                            <p>10 Million</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="well">
                            <h4>Bounce</h4>
                            <p>30%</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-9">
                        <table data-user-id="<?php echo $userId; ?>">
                        
                        <tr>
                            <th>Product Name</th>
                            <th>Product Quantity</th>
                            <th>Warehouse Name</th>
                            <th>Store Quantity</th>
                            <th>Storehouse Name</th>
                            <th>Sub Total</th>
                            <th>Total Product</th>
                        </tr>
                    
                    <tbody id="productsTableBody">
                        <!-- Product data will be dynamically populated here -->
                    </tbody>
                </table>
            </div>


        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script type="text/javascript" src="../authentication/authentication_module.js"></script> -->
    <script type="text/javascript" src="../dashboard/dashboard_script.js"></script>
    <!-- <script type="text/javascript" src="../product/product_script.js"></script> -->

</body>

</html>