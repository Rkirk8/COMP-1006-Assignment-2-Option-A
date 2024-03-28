<?php
include ('Shared/header.php');
// Capture inputs
$userName = $_POST['username'];
$password = $_POST['password'];

try {
    // Connect
    include('Shared/db.php');
    $sql = "SELECT * FROM users WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $userName, PDO::PARAM_STR, 50);
    $cmd->execute();
    $user = $cmd->fetch();

    // Look for user
    if (empty($user)) {
        $db = null;
        header('location:login.php?invalid=true');
    }
    // Check password
    if (!password_verify($password, $user['password'])) {
        header('location:login.php?invalid=true');
    } else {
        // Store identity in session object on web server
        session_start();
        $_SESSION['username'] = $userName;
        $db = null;
        header('location:index.php');
        echo '<script>console.log("Login Successful")</script>';
    }
    //Redirect back to homepage
} catch (Exception $err) {
    header('location:error.php');
    exit();
}

?>