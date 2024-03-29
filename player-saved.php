<?php
include('Shared/auth.php');
$title = 'Saving Player Saved';
include('Shared/header.php');

// Check if player is already in db
// Connect to db
include('Shared/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract player name from form data
    $playerName = $_POST['playerName'];

    // Check if player already exists in the database
    $sql = "SELECT * FROM players WHERE playerName = :playerName";
    $stat = $db->prepare($sql);
    $stat->execute(array(':playerName' => $playerName));
    $data = $stat->fetch();

    // If player is in the db, show error
    if ($data ) {
        echo 'The player is already in the database';
    } else {
        // Check if file was uploaded
        if ($_FILES['playerPhoto']['size'] > 0) {
            // User uploaded a photo
            $photoName = $_FILES['playerPhoto']['name'];
            $finalName = session_id() . '-' . $photoName; 

            // Temp location in server cache
            $tmp_name = $_FILES['playerPhoto']['tmp_name'];

            // File type
            $type = mime_content_type($tmp_name);

            // Check if file type is valid
            if ($type != 'image/jpeg' && $type != 'image/png') {
                echo 'Photo must be a .jpg or .png';
                exit();
            } else {
                move_uploaded_file($tmp_name, 'image/headshots/' . $finalName);
            }
        } else {
            $defaultPhoto = 'image/headshots/defaultHeadshot.png';
            $finalName = session_id() . '-' . $defaultPhoto; 
            copy($defaultPhoto, 'imege/headshots/' . $finalName);
        }

        // Capture form inputs into vars
        $name = $_POST['playerName'];
        $age = $_POST['playerAge'];
        $position = $_POST['playerPosition'];
        $ok = true;

        // Input validation before save
        if (empty($name)) {
            echo 'Name is required<br />';
            $ok = false;
        }

        if (empty($position)) {
            echo 'Position is required<br />';
            $ok = false;
        }

        if ($ok) {
            try {
                // Set up SQL INSERT command
                $sql = "INSERT INTO players (playerName, playerAge, position, photo) 
                        VALUES (:name, :age, :position, :photo)";
                // Prepare the statement
                $cmd = $db->prepare($sql);
                // Map each input to a column in the players table
                $cmd->bindParam(':name', $name, PDO::PARAM_STR, 100);
                $cmd->bindParam(':age', $age, PDO::PARAM_INT);
                $cmd->bindParam(':position', $position, PDO::PARAM_STR, 50);
                $cmd->bindParam(':photo', $finalName, PDO::PARAM_STR, 100);

                // Execute the INSERT (which saves to the db)
                $cmd->execute();

                // Show message to user
                echo 'Player Saved';
            } catch (Exception $err) {
                echo 'Error saving player: ' . $err->getMessage();
            }
        }
    }
}

// Close database connection
$db = null;
?>
</body>
</html>
