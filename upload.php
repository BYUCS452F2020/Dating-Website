<?php
require_once('lib/php/db_connect.php');
require_once('lib/php/users.php');
$mysqli = getConnection();
$user_id = getUserID();

// Check if the form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if file was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png", "JPG" => "image/JPG", "PNG" => "image/PNG");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];
    
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
    
        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
    
        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists("/var/www/html/Dating-Website/images/" . $filename)){
                echo $filename . " is already exists.";
            } else{
		copy($_FILES["photo"]["tmp_name"], "/var/www/html/Dating-Website/images/" . $filename);
                $mysqli->query("INSERT INTO Dating_Website.Image (user_id, filename) VALUES ('$user_id', '$filename')");
		if ($mysqli->error){
		    echo "<script>alert('There was a db error: " . $mysqli->error . "');</script.php>";
		}
		else{
                    echo "<script>alert('Your file was uploaded successfully.');window.location.replace('http://136.36.9.168:8080/Dating-Website/index.php');</script>";
		}
            } 
        } else{
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } else{
        echo "Error: " . $_FILES["photo"]["error"];
    }
}
?>
