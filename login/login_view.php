<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="login_style.css">
<title>Login Page</title>
</head>
<body>

<h2>Inventory Management System</h2>

<div class="container">
  
    <div class="row">
      <h2 style="text-align:center">Welcome To Our System</h2>
      <div class="vl">
        <span class="vl-innertext">or</span>
      </div>

      <div class="col">
        <a href="#" class="fb btn">
          <i class="fa fa-facebook fa-fw"></i> Login with Facebook
         </a>
        <a href="#" class="twitter btn">
          <i class="fa fa-twitter fa-fw"></i> Login with Twitter
        </a>
        <a href="#" class="google btn"><i class="fa fa-google fa-fw">
          </i> Login with Google+
        </a>
      </div>

      <div class="col">
        
        <form id="login-form">
            <input type="text"  id="phone-number" placeholder="Phone Number" required>
            <input type="password"  id="password" placeholder="Password" required>
            <input type="submit" id="login-button" value="Login">
        </form>
      </div>
      
    </div>
  
</div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="./login_script.js"></script>



</body>
</html>
