<?php 
include('Shared/auth.php');
include('Shared/header.php');

// playerId is passed from the view players page
$playerId = $_GET['playerId'];

if (is_numeric($playerId)) {
    try {
        include('Shared/db.php');
        //sql query
        $sql = "DELETE FROM players WHERE playerId = :playerId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':playerId', $playerId, PDO::PARAM_INT);
        $success = $cmd->execute();
        //close connection
        $db = null;
        //redirect
        if ($success) {
            echo 'Player Deleted';
            header('Location: view-players.php');
            exit();
        } else {
            echo 'Failed to delete player.';
        }
    } catch (Exception $err) {
        header('Location: error.php');
        exit();
    }
} else {
    echo 'Invalid player ID.';

}
?>

