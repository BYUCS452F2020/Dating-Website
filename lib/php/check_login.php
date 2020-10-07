<?php

include_once "./lib/php/users.php";
include_once "./lib/php/js_load.php";

if (!isLoggedIn()){
    echo "<script>location.replace('login.php?redirect=" . basename($_SERVER['PHP_SELF']) . "');</script>";
}
else {
    $js = "
    
    <script>
    function doLogout(){
		
		callPhpFunction(\"doLogout\", [], finishLogout);
	}
	
	function finishLogout(obj, textstatus){
		location.reload();
	}
    </script>";
    
    echo $js . "<a href='javascript:doLogout();'>Logout</a>";
}