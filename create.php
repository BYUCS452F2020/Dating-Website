<?php
require_once("lib/php/db_connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Create Account - Dating Website</title>
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
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<body>
<div style="margin-left:20%; margin-right:20%;">
<div style="justify-content: center">
    <h1>Create New Account</h1>
    <hr/>
</div>
<label for="fname">First Name: </label><input type="text" id="fname" /><br/>
<label for="lname">Last Name: </label><input type="text" id="lname" /><br/>
<label for="email">Email: </label><input type="text" id="email" /><br/>
<label for="birthday">Birthday: </label><input type="date" id="birthday" /><br/>
<label for="phone">Phone Number: </label><input type="text" id="phone" /><br/>
<label for="password">Password: </label><input type="password" id="password" /><br/>
<span>Gender: </span>
<input type="radio" id="male" name="gender" value="M" checked><label for="male"> Male </label>&emsp;
<input type="radio" id="female" name="gender" value="F"><label for="female"> Female </label><br/>
<p>Please enter a short biography to describe yourself: (limit 500 characters)</p>
<textarea id="biography" rows="5" cols="100" maxlength="500"></textarea><br><br>
<span>Height: </span>
<label for="feet">Feet: </label><input type="number" id="feet">&emsp;
<label for="inches">Inches: </label><input type="number" id="inches"><br/>
<label for="major">Major: </label><input type="text" id="major"><br/>
<label for="work">Work: </label><input type="text" id="work"><br/>
<label for="hometown">Hometown: </label><input type="text" id="hometown"><br/>
<button onclick="submit()">Submit</button>
</div>
</body>
</html>

<script>
    function submit(){
        fname = $('#fname').val();
        lname = $('#lname').val();
        email = $('#email').val();
        birthday = document.getElementById("birthday").value;
        phone = $('#phone').val();
        password = $('#password').val();
        gender = $("input[name='gender']:checked").val();
        biography = $('textarea#biography').val();
        feet = $('#feet').val();
        inches = $('#inches').val();
        major = $('#major').val();
        work = $('#work').val();
        hometown = $('#hometown').val();
        if (fname == '' || lname == '' || email == '' || phone == '' || password == '' || biography == '' || major == '' || work == '' || hometown == ''){
            alert('All fields are required. Please fill in any blank fields.');
        }
        else{
            $.ajax({
                type: "POST",
                url: "registerSubmit.php",
                data: {fname:fname, lname:lname, email:email, birthday:birthday, phone:phone, password:password, gender:gender, biography:biography, feet:feet, inches:inches, major:major, work:work, hometown:hometown},
                success: function(data, status, jqxhr) {
                    if (data['status'] === "success") {
                        alert('new account created successfully!');
			if (data['message'] == ''){
			    window.location.replace('imageForm.php');
			}
                    }
                    else{
                        alert ("client error: " + data['cause']);
                    }
                },
                error: function(XMLHttpTicket, status, error) {
                    alert("server error: " + error);
                }
            });
        }
    }
</script>
