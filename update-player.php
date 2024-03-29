<?php 
include('Shared/db.php');

// Capture form inputs into variables
$playerID = $_POST['playerId'];
$playerName = $_POST['playerName'];
$playerAge = $_POST['playerAge'];
$position = $_POST['position'];
$currentHeadshot = $_POST['currentHeadshot'];

// Process photo if any
if ($_FILES['photo']['size'] > 0) {
    // Handle file upload
    $photoName = $_FILES['photo']['name'];
    $photoTemp = $_FILES['photo']['tmp_name'];
    $finalName = session_id() . '-' . $photoName;

    // Check file type
    $allowedTypes = ['image/jpeg', 'image/png'];
    $type = mime_content_type($photoTemp);
    if (!in_array($type, $allowedTypes)) {
        echo 'Photo must be a .jpg or .png<br />';
        exit();
    } else {
        // Save file to image/headshots directory
        $uploadPath = 'image/headshots/' . $finalName;
        if (move_uploaded_file($photoTemp, $uploadPath)) {
            echo 'Photo uploaded successfully!<br />';
        } else {
            echo 'Failed to upload photo!<br />';
        }
        // Update photo variable
        $currentHeadshot = $finalName;
    }
}

try {
    // Set up SQL UPDATE command
    $sql = "UPDATE players 
            SET 
            playerName = :playerName, 
            playerAge = :playerAge, 
            position = :position, 
            photo = :photo 
            WHERE 
            playerID = :playerID";

    // Link database connection with SQL command
    $cmd = $db->prepare($sql);
    // Map each input to a column in the players table
    $cmd->bindParam(':playerName', $playerName, PDO::PARAM_STR, 100);
    $cmd->bindParam(':playerAge', $playerAge, PDO::PARAM_INT);
    $cmd->bindParam(':position', $position, PDO::PARAM_STR, 50);
    $cmd->bindParam(':photo', $currentHeadshot, PDO::PARAM_STR, 100);
    $cmd->bindParam(':playerID', $playerID, PDO::PARAM_INT);
    // Execute the update (which saves to the database)
    $cmd->execute();
    // Disconnect
    $db = null;
    // Redirect to edit-player.php with success message
    echo '<script>alert("Player updated successfully!");</script>';
    header('Location: veiw-team.php');
    exit();
} catch (PDOException $err) {
    echo "Database Error: " . $err->getMessage();
    exit();
}
?>
