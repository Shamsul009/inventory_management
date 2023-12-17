function checkUserTypeAndRedirect(user_types_id,userId,auth,event) {

    event.preventDefault();

    // console.log('user_types_id:', user_types_id);
    // console.log('userId:', userId);
    
    if (user_types_id === 1 && auth===1) {
        // Redirect to the Product Create page
        window.location.href = '../product/product_form.php?user_id='+userId;
        return;
    }
    else if (user_types_id === 3 && auth===3) {
        // Redirect to the Product Create page
        window.location.href = '../warehouse/warehouse_view.php?user_id='+userId+'&user_types_id='+user_types_id;
        return;
    }
    else {
        // Display a message or take alternative action
        alert('You do not have permission to access this page.');
    }

    
}