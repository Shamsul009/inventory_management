// Have a reference to the table element
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
        url: 'dashboard_db.php', 
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
                    var row = `<tr>
                                    <td>${product.product_name}</td>
                                    <td>${product.house_product_quantity}</td>
                                    <td>${product.warehouse_name}</td>
                                    <td>${product.store_product_quantity}</td>
                                    <td>${product.store_name}</td>
                                    <td>${parseInt(product.store_product_quantity) + parseInt(product.house_product_quantity)}</td>
                                    <td>${product.total_product}</td>
                            </tr>`;
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