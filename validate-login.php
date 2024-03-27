<?php
//capture inputs
$userName = $_POST['username'];
$password = $_POST['password'];
//validate
try {
    //connect
    include('shared/db.php');
    $sql = "SELECT * FROM users WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $userName, PDO::PARAM_STR, 50);
    $cmd->execute();
    $user = $cmd->fetch();
    //look for user
    if (empty($user)) {
        $db = null;
        header('location:login.php?invalid=true');
    }
    //if user is found check password
    if (!password_verify($password, $user['password'])) {
        $db = null;
        header('location:login.php?invalid=true');
    } else {
        // store identity in session object on web server
        session_start();
        $_SESSION['username'] = $userName;
        $db = null;
        header('location:shows.php');
    }}
catch (Exception $err) {
    header('location:error.php');
    exit();
}
?>