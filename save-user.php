<?php
include ('Shared/header.php');
// Include database connection
include('Shared/db.php');

// Capture form inputs
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];

try {
    // Validate inputs
    if (empty($username)) {
        throw new Exception('Username is required');
    }

    if (strlen($password) < 8 || !preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $password)) {
        throw new Exception('Password must be a minimum of 8 characters, including 1 digit, 1 upper-case letter, and 1 lower-case letter.');
    }

    if ($password != $confirm) {
        throw new Exception('Passwords must match');
    }

    // Check for duplicate username
    $sql = "SELECT * FROM users WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();
    $users = $cmd->fetchAll();

    if (!empty($users)) {
        // Username already exists
        throw new Exception('Username already exists');
    } else {
        // Hash the password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        // Insert new user
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->bindParam(':password', $passwordHash, PDO::PARAM_STR, 255);
        $cmd->execute();
    }

    // Redirect to login page
    header('location:login.php');

    // Disconnect
    $db = null;
} catch (Exception $err) {
    header('location: error.php?msg=' . urlencode($err->getMessage()));
    exit();
}


