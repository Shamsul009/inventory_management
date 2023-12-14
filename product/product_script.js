// function checkUserTypeAndRedirect(user_types_id,userId) {
//     // Fetch user_types_id from wherever it's available (e.g., a server response, session, etc.)
    
//     // Check if user_types_id is 1 (or the desired value)
//     if (user_types_id === 1) {
//         // Redirect to the Product Create page
//         window.location.href = '../product/product_form.php?user_id='+userId;
//     } else {
//         // Display a message or take alternative action
//         alert('You do not have permission to access this page.');
//     }
// }

$('#productForm').submit(function(e) {
    e.preventDefault();

    // Get form data
    var companyId = $('#companyId').val()
    var productName = $('#productName').val();
    var productQuantity = $('#productQuantity').val();
    var warehouseName = $('#warehouseName').val();
    var storeproductQuantity = $('#storeproductQuantity').val();
    var storehouseName = $('#storehouseName').val();
    var productTotal = $('#productTotal').val();

    console.log(productTotal)

    // Send data to product_db.php along with user_id
    $.ajax({
        url: 'product_db.php',
        method: 'POST',
        data: {
            company_id: companyId,
            productName: productName,
            productQuantity: productQuantity,
            warehouseName: warehouseName,
            storeproductQuantity: storeproductQuantity,
            storehouseName: storehouseName,
            productTotal: productTotal
        },
        // dataType: 'json',
        success: function(response) {
            // Handle the response from product_db.php
            console.log(response);

            try {
                response = JSON.parse(response);
            } catch (e) {
                console.error('Error parsing JSON:', e);
                return;
            }


            // Reset the form if the submission was successful
            if (response.success) {
                $('#productForm')[0].reset();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error submitting the form:', status, error);
        }
    });
});
