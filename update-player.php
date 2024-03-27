<?php
$title = 'Saving Player Updates...';
include('shared/header.php');
include('shared/auth.php');

// Capture form inputs into variables
$playerId = $_POST['playerId'];  // ID value from hidden input on form
$playerName = $_POST['playerName'];
$playerAge = $_POST['playerAge'];
$position = $_POST['position'];
// Input validation before saving
if (empty($playerName)) {
    echo 'Player Name is required<br />';
    $ok = false;
}
if (empty($playerAge)) {
    echo 'Player Age is required<br />';
    $ok = false;
} else {
    if (!is_numeric($playerAge)) {
        echo 'Player Age must be a number<br />';
        $ok = false;
    }
}
if (empty($position)) {
    echo 'Position is required<br />';
    $ok = false;
}
// Process photo if any
if ($_FILES['photo']['size'] > 0) {
    $photoName = $_FILES['photo']['name'];
    $photoTemp = $_FILES['photo']['tmp_name'];
    $photo = 'image/headshots/' . $photoName;
    // File type
    $type = mime_content_type($photoTemp);
    if ($type != 'image/jpeg' && $type != 'image/png') {
        echo 'Photo must be a .jpg or .png<br />';
        $ok = false;
    } else {
        // Save file to image/headshots directory
        move_uploaded_file($photoTemp, $photo);
    }
} else {
    // Use current photo if none is uploaded
    $photo = $_POST['currentHeadshot'];
}
if ($ok) {
    try {
        // Connect to the database using PDO
        include('shared/db.php');
        // Set up SQL UPDATE command
        $sql = "UPDATE players SET playerName = :playerName, playerAge = :playerAge, position = :position, photo = :photo WHERE playerId = :playerId";
        // Link database connection with SQL command
        $cmd = $db->prepare($sql);
        // Map each input to a column in the players table
        $cmd->bindParam(':playerName', $playerName, PDO::PARAM_STR, 100);
        $cmd->bindParam(':playerAge', $playerAge, PDO::PARAM_INT);
        $cmd->bindParam(':position', $position, PDO::PARAM_STR, 50);
        $cmd->bindParam(':photo', $photo, PDO::PARAM_STR, 100);
        $cmd->bindParam(':playerId', $playerId, PDO::PARAM_INT);
        // Execute the update (which saves to the database)
        $cmd->execute();
        // Disconnect
        $db = null;
        // Show message to user
        echo 'Player Updated';
    } catch (Exception $err) {
        header('location:error.php');
        exit();
    }
}
?>
</main>
</body>
</html>

