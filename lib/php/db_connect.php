<?php


function getConnection(){
	$mysqli = new mysqli('136.36.9.168', 'cs452', 'UTCLwQln%&zBfu7Ja5P8@s$KS', 'Dating_Website', 33306);
	if ($mysqli->connect_errno){
		echo "Failed to connect to database.";
		die();
	}
	else {
		return $mysqli;
	}
}

function doSelect($query){
	$returnArray = array();

	$conn = getConnection();

	$result = $conn->query($query);



	if ($result) {
	  // output data of each row
	  while ($row = mysqli_fetch_assoc($result)){
		array_push($returnArray, $row);
	  }
	}

	$conn->close();

	return $returnArray;
}
