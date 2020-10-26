<?php

include_once "db_connect.php";

$userCookieKey = "email";

/**
 * Attempts to log a user into the system
 *
 * @param string $username the username provided by the user
 * @param string $password the password provided by the user
 *
 * @return array an array with elements 'success' and 'messsage'
 */
function doLogin($username, $password){
    
    global $userCookieKey;
    
    $returnValue = array();
    $success = false;
    $message = "";
    
    $result = doSelect("select email from Users where email = '{$username}' and password = '{$password}'");
    
    if (count($result) == 1){
        setcookie($userCookieKey, $result[0]['email'], 0, "/");
        $success = true;
    }
    else {
        $success = false;
        $message = "Username/password combination was not correct.";
    }
    
    $returnValue['success'] = $success;
    $returnValue['message'] = $message;
    
    return $returnValue;
    
}

/**
 * Signs the currently signed in user out of the system
 */
function doLogout(){
    
    global $userCookieKey;
    
    setcookie($userCookieKey, "", time() - 3600, "/");
}

/**
 * Returns whether there is a user currently logged into the system
 *
 * @return boolean true if there is a user currently logged in, false otherwise
 */
function isLoggedIn(){
    
    global $userCookieKey;
    return isset($_COOKIE[$userCookieKey]);
}

/**
 * Returns the ID of the currently logged in user
 *
 * @return the ID of the currently logged in user
 */
function getUserID(){
    
    global $userCookieKey;
    if (isLoggedIn()){
        return $_COOKIE[$userCookieKey];
    }
    else {
        return "";
    }
}