<?php
// Start session if not already started
if (!isset($_SESSION)) {
    session_start();
} 
// Include database connection
include('shared/db.php');
// Capture form inputs
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;
try {
    // Validate inputs
    if (empty($username)) {
        echo 'Username is required<br />';
        $ok = false;
    }
    if (strlen($password) < 8 || !preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $password)) {
        echo 'Password must be a minimum of 8 characters, including 1 digit, 1 upper-case letter, and 1 lower-case letter.<br />';
        $ok = false;
    }
    if ($password != $confirm) {
        echo 'Passwords must match<br />';
        $ok = false;
    }
    // Hash the password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    if ($ok) {
        // Check for duplicate username
        $sql = "SELECT * FROM users WHERE username = :username";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->execute();
        $users = $cmd->fetchAll();

        if (!empty($users)) {
            // Username already exists
            echo 'Username already exists<br />';
            exit();
        }
        // Insert new user
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->bindParam(':password', $passwordHash, PDO::PARAM_STR, 255);
        $cmd->execute();
        // Redirect to login page
        header('location: login.php');
        exit();
    }
    // Disconnect
    $db = null;
}
catch (Exception $err) {
    header('location: error.php');
    exit();
}
?>
