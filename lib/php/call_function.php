<?php

include_once "users.php";

header('Content-Type: application/json');

$aResult = array();

if( !isset($_POST['functionname']) ) {
    $aResult['error'] = 'No function name!';
}

/*if( !isset($_POST['arguments']) ) {
    $aResult['error'] = 'No function arguments!';
}*/

if( !isset($aResult['error']) ) {
    
    $functionName = $_POST['functionname'];
    $params = $_POST['arguments'];
    
    if ($params == null){
        $params = array();
    }
    
    $aResult = call_user_func_array($functionName, $params);
}
else {
    http_response_code(400);
}

echo json_encode($aResult);
