<?php 
include('shared/auth.php');
include('shared/header.php');

// playerId is passed from the view players page
$playerId = $_GET['playerId'];

if (is_numeric($playerId)) {
    try {
        // Connect to the database
        include('shared/db.php');
        
        // Prepare SQL delete statement
        $sql = "DELETE FROM players WHERE playerId = :playerId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':playerId', $playerId, PDO::PARAM_INT);
        
        // Execute the delete query
        $success = $cmd->execute();
        
        // Disconnect from the database
        $db = null;
        
        if ($success) {
            // Let the user know the player was deleted
            echo 'Player Deleted';
            // Redirect to the view-players.php page
            header('Location: view-players.php');
            exit(); // Stop execution to prevent further output
        } else {
            // If deletion was not successful, display an error message
            echo 'Failed to delete player.';
        }
    } catch (Exception $err) {
        // If any exception occurs, redirect to the error page
        header('Location: error.php');
        exit(); // Stop execution to prevent further output
    }
} else {
    // If playerId is not numeric, display an error message
    echo 'Invalid player ID.';
}
?>
