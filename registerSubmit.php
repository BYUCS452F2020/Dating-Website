<?php
header('Content-type: application/json');
date_default_timezone_set('America/Denver');

require_once("lib/php/db_connect.php");
require_once("lib/php/users.php");
$mysqli = getConnection();

$fname = $mysqli->real_escape_string($_POST['fname']);
$lname = $mysqli->real_escape_string($_POST['lname']);
$email = $mysqli->real_escape_string($_POST['email']);
$birthday = $_POST['birthday'];
$phone = $mysqli->real_escape_string($_POST['phone']);
$password = $mysqli->real_escape_string($_POST['password']);
$gender = $_POST['gender'];
$biography = $mysqli->real_escape_string($_POST['biography']);
$feet = $_POST['feet'];
$inches = $_POST['inches'];
$major = $mysqli->real_escape_string($_POST['major']);
$work = $mysqli->real_escape_string($_POST['work']);
$hometown = $mysqli->real_escape_string($_POST['hometown']);
$height = $feet * 12 + $inches;

$mysqli->query("INSERT INTO Dating_Website.Profile (user_id, bio, first_name, last_name, height, major, work, hometown) VALUES ('$email', '$biography', '$fname', '$lname', '$height', '$major', '$work', '$hometown')");

if ($mysqli->error){
    $response_array['cause'] = 'SQL error.' . $mysqli->error;
}
else{
    $mysqli->query("INSERT INTO Dating_Website.Users (date_of_birth, email, phone, password, gender) VALUES ('$birthday', '$email', '$phone', '$password', '$gender')");

    if ($mysqli->error){
        $response_array['cause'] = 'SQL error2.' . $mysqli->error;
    }
    else{
        $response_array['status'] = 'success';
	$login = doLogin($email, $password);
	$response_array['message'] = $login['message'];
    }
}
echo json_encode ($response_array);
?>
