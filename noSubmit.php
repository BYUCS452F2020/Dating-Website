<?php
header("Content-Type: application/json");

include_once('lib/php/db_connect.php');
include_once('lib/php/users.php');
$mysqli = getConnection();

$response_array['status'] = 'incomplete';

$liker = getUserID();
$likee = $_POST['person'];

$myQuery = $mysqli->query("SELECT person1 FROM Dating_Website.Liked WHERE person1 = '$likee' AND person2 = '$liker'");

if ($myQuery != False && $myQuery->fetch_assoc()){
    $mysqli->query("UPDATE Dating_Website.Liked SET matched = 0 WHERE person1='$likee' AND person2='$liker'");
}
else{
    $mysqli->query("INSERT INTO Dating_Website.Liked (person1, person2, matched) VALUES ('$liker', '$likee', 0)");
}

if ($mysqli->error){
    $response_array['cause'] = $mysqli->error;
}
else{
    $response_array['status'] = 'success';
}

echo json_encode ($response_array);
?>
