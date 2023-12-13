function checkUserTypeAndRedirect(user_types_id,userId) {
    // Fetch user_types_id from wherever it's available (e.g., a server response, session, etc.)
    
    // Check if user_types_id is 1 (or the desired value)
    if (user_types_id === 1) {
        // Redirect to the Product Create page
        window.location.href = '../product/product_form.php?user_id='+userId;
    } else {
        // Display a message or take alternative action
        alert('You do not have permission to access this page.');
    }
}