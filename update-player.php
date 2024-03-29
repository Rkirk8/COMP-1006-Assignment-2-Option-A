<?php
$title = 'Saving Player Updates...';
include('Shared/header.php');
include('Shared/auth.php');

// Capture form inputs into variables
$playerId = $_POST['playerId']; 
$playerName = $_POST['playerName'];
$playerAge = $_POST['playerAge'];
$position = $_POST['position'];
$newPhoto = $_POST['newPhoto'];
$curphoto = $_POST['currentHeadshot'];
$pass = true;
// Input validation before saving
if (empty($playerName)) {
    echo 'Player Name is required<br />';
    $pass = false;
}
if (empty($playerAge)) {
    echo 'Player Age is required<br />';
    $pass = false;
} else {
    if (!is_numeric($playerAge)) {
        echo 'Player Age must be a number<br />';
        $pass = false;
    }
}
if (empty($position)) {
    echo 'Position is required<br />';
    $pass = false;
}
// Process photo if any
if ($_FILES['newPhoto']['size'] > 0) {
    $photoName = $_FILES['newPhoto']['name'];
    $photoTemp = $_FILES['newPhoto']['tmp_name'];
    $photo = 'image/headshots/' . $photoName;
    // File type
    $type = mime_content_type($photoTemp);
    if ($type != 'image/jpeg' && $type != 'image/png') {
        echo 'Photo must be a .jpg or .png<br />';
        $pass = false;
    } else {
        // Save file to image/headshots directory
        move_uploaded_file($photoTemp, $photo);
    }
} else {
    // Use current photo if none is uploaded
    $photo = ;
}
if ($pass == true) {
    try {
        // Connect to the database using PDO
        include('Shared/db.php');
        echo '<script>console.log("Connected!")</script>';
        // Set up SQL UPDATE command
        $sql = "UPDATE players
SET 
    playerName = :playerName,
    playerAge = :playerAge,
    position = :position,
    playerphoto = :photo
WHERE 
    playerID = :playerID";

        // Link database connection with SQL command
        $cmd = $db->prepare($sql);
        // Map each input to a column in the players table
        $cmd->bindParam(':playerName', $playerName, PDO::PARAM_STR, 100);
        $cmd->bindParam(':playerAge', $playerAge, PDO::PARAM_INT);
        $cmd->bindParam(':position', $position, PDO::PARAM_STR, 50);
        $cmd->bindParam(':photo', $photo, PDO::PARAM_STR, 100);
        $cmd->bindParam(':playerID', $playerID, PDO::PARAM_INT);
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

