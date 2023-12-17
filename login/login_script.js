$(document).ready(function () {
    $("#login-form").submit(function (e) {
        e.preventDefault(); // Prevent the default form submission

        // console.log("clicked")
        // Collect form data

        var phoneNumber = $("#phone-number").val();
        var password = $("#password").val();

        // console.log(phoneNumber)

        // Make AJAX request
        $.ajax({
            type: "POST",
            url: "login_db.php",
            data: {
                phone_number: phoneNumber,
                password: password
            },
           
            success: function (response) {
                console.log(response);
                try {
                    response = JSON.parse(response);
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    return;
                }
                // Handle the successful response here
                var user = response.user
                // console.log(user.id);

                //  console.log(typeof response.success, response.success);


                if (response.success) {
                    // Redirect to another page if login was successful
                    window.location.href = '../dashboard/dashboard_view.php?user_id='+ user.id + '&user_types_id='+user.user_types_id;
                } else {
                    // Display an error message or perform other actions
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                // Handle errors here
                console.error("AJAX request failed with status: " + status + ", error: " + error);
            }
        });
    });
});
