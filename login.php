<?php

include_once "./lib/php/users.php";

$redirectURL = $_GET['redirect'];

if (isLoggedIn()){
	echo "<script>location.replace('{$redirectURL}');</script>";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Dating Website Log In</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
.login-form {
    width: 340px;
    margin: 50px auto;
  	font-size: 15px;
}
.login-form form {
    margin-bottom: 15px;
    background: #f7f7f7;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.login-form h2 {
    margin: 0 0 15px;
}
.form-control, .btn {
    min-height: 38px;
    border-radius: 2px;
}
.btn {        
    font-size: 15px;
    font-weight: bold;
}
</style>
</head>
<body>
<div class="login-form">
    <form action="javascript:doLogin()">
        <h2 class="text-center">Log in</h2>       
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" id="username" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" id="password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
        </div>
        <div class="clearfix">
            <a href="#" class="float-right">Forgot Password?</a>
        </div>        
		<div id="errorMessage" style='color: red'></div>
    </form>
    <p class="text-center"><a href="create.php">Create an Account</a></p>
</div>
</body>

<script src="./lib/javascript/api.js"></script>
<script>
	
	function doLogin(){
		
		var username = document.getElementById("username").value;
		var password = document.getElementById("password").value;
		
		callPhpFunction("doLogin", [username, password], finishLogin);
	}
	
	function finishLogin(obj, textstatus){
		if (obj.success){
			document.getElementById("errorMessage").innerHTML = "";
			location.replace("<?php echo $redirectURL?>");
		}
		else {
			document.getElementById("errorMessage").innerHTML = obj.message;
		}
	}
</script>
</html>