<?php
include('Shared/auth.php');
$title = 'Saving Player Saved';
include('Shared/header.php');

//check if player is already in db
// connect to db
include ('Shared/database.php');
// check to see if player is already in the db
$sql = "SELECT * FROM players WHERE playerName = :playerName";
$stat = $db->prepare($sql);
$stat->execute(array(':playerName' => $playerName));
$data = $stat->fetch();
// if player is in the db, show error
if($data){
    echo 'The player is already in the database';
} else {
// Set default photo name
$defaultPhotoName = 'defaultHeadshot.jpeg';

// process photo if any
if ($_FILES['playerPhoto']['size'] > 0) { 
    // User uploaded a photo
    $photoName = $_FILES['playerPhoto']['name'];
    $finalName = session_id() . '-' . $photoName;

    // temp location in server cache
    $tmp_name = $_FILES['playerPhoto']['tmp_name'];

    // file type
    $type = mime_content_type($tmp_name);

    if ($type != 'image/jpeg' && $type != 'image/png') {
        echo 'Photo must be a .jpg or .png';
        exit();
    }
    else {
        // save file to img/uploads
        move_uploaded_file($tmp_name, 'img/uploads/' . $finalName);
    }
} else {
    // No photo uploaded, use default photo
    $finalName = $defaultPhotoName;
}
// capture form inputs into vars
$name = $_POST['playerName'];
$age = $_POST['playerAge'];
$position = $_POST['playerPosition'];
$ok = true;

// input validation before save
if (empty($name)) {
    echo 'Name is required<br />';
    $ok = false;
}

if (empty($position)) {
    echo 'Position is required<br />';
    $ok = false;
}

if ($ok == true) {
    try {
        // set up SQL INSERT command
        $sql = "INSERT INTO players (PlayerName, playerAge, position, photo) 
                VALUES (:name, :age, :position, :photo)";
        // map each input to a column in the players table
        $cmd->bindParam(':name', $name, PDO::PARAM_STR, 100);
        $cmd->bindParam(':age', $age, PDO::PARAM_INT);
        $cmd->bindParam(':position', $position, PDO::PARAM_STR, 50);
        $cmd->bindParam(':photo', $finalName, PDO::PARAM_STR, 100);

        // execute the INSERT (which saves to the db)
        $cmd->execute();

        // show msg to user
        echo 'Player Saved';
    }
    catch (Exception $err) {
        echo 'Error saving player: ' . $err->getMessage();
    }
} 
}
// close database connection
$db = null;
?>
