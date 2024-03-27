<?php 
include('shared/auth.php');
include('shared/header.php');
// playerId is passed in from the view players page
$playerId = $_GET['playerId'];

if (is_numeric($playerId)) {
    try {
        // connect
        include('shared/db.php');
        // prep sql delete statement
        $sql = "DELETE FROM players WHERE playerId = :playerId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':playerId', $playerId, PDO::PARAM_INT);
        // execute
        $cmd->execute();
        //disconnect 
        $db = null;
        //let user know then redirect
        echo 'Player Deleted';
        header('location:view-players.php');
    } catch (Exception $err) {
        header('location:error.php');
        exit();
    }
}
?>