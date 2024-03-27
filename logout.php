<?php
//get the current session then destroy it
session_start();
session_destroy();
// confirm the session is destroyed
var_dump(session_status() == PHP_SESSION_NONE);
// let user know they are logged out
echo 'You are now logged out'; 
//return to index 
header('location: index.php');
?>