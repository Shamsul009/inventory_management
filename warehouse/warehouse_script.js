// Assuming you have a reference to the table element
var table = document.querySelector('table');

// Access the user_id attribute
var userId = table.getAttribute('data-user-id');

onTableLoad(userId)

// console.log(userId)

function onTableLoad(userId) {
    // var userId = table.getAttribute('data-user-id');
    console.log(userId)
    // This function will be called when the entire page is loaded

    // Fetch products using AJAX
    $.ajax({
        url: 'warehouse_db.php', // Replace with the actual path to your PHP script
        method: 'GET',
       
        data: { user_id: userId},
        success: function(response) {
            // console.log(response)
            response = JSON.parse(response);
            // console.log(response)

            if (response.success) {
                // Populate the table with product data
                var productsTableBody = $('#productsTableBody');
                $.each(response.products, function(index, product) {
                    var row = '<tr>';
                    row += '<td>' + product.product_name + '</td>';
                    row += '<td>' + product.house_product_quantity + '</td>';
                    // row += '<td><button>Update</button></td>';
                  
                    row += '<td><button onclick="updateProduct(' + product.product_id + ')">Delivery</button></td>';
                    row += '</tr>';
                    productsTableBody.append(row);
                });
            } else {
                console.log(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching products:', status, error);
        }
    });
}


// Assuming you have a function named 'updateProduct' defined somewhere
function updateProduct(productId) {
    // Implement the logic to handle the update for the given productId
    console.log('Updating product with ID:', productId);
    var updateForm = document.getElementById('updateForm');
    // console.log(updateForm)
    if (updateForm) {
        updateForm.querySelector('#productId').value = productId;
        updateForm.style.display = 'block';
    }

    // Show the update form or perform other actions
    // showUpdateForm(productId);
}


function submitUpdateForm() {

    var productId = document.getElementById('productId').value;
   
    var deliveryProductQuantity = document.getElementById('deliveryProductQuantity').value;
    var storehouseName = document.getElementById('storehouseName').value;
    var warehouseID = document.getElementById('warehouseID').value;
    var companyID = document.getElementById('companyID').value;

    // console.log(productId)
    // console.log(deliveryProductQuantity)
    // console.log(storehouseName)
    // console.log(warehouseID)
    // console.log(companyID)
    

//     // Prepare the data to be sent
    var formData = {
        productId: productId,
        deliveryProductQuantity: deliveryProductQuantity,
        storehouseName: storehouseName,
        warehouseID: warehouseID,
        companyID: companyID
    };

    // Send the data using AJAX
    $.ajax({
        url: 'warehouse_update_db.php', // Replace with the actual path to your PHP script
        method: 'POST',
        data: formData,
        success: function(response) {

            try {
                response = JSON.parse(response);
                if (response.success) {
                    console.log(response.message);
                    $('#updateForm')[0].reset();
                } else {
                    // Handle errors, e.g., display an error message
                    console.error(response.message);
                }
            } catch (e) {
                console.error('Error parsing JSON:', e);
                return;
            }

            
        },
        error: function(xhr, status, error) {
            console.error('Error submitting form:', status, error);
        }
    });
}

