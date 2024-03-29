<?php 
include('Shared/auth.php');
$title = 'Edit Player';
include('Shared/header.php'); 
include('Shared/db.php');
//get playerId

$playerID = $_GET['playerID'];

//fatch player from db
try {
    $sql = "SELECT * FROM players WHERE playerId = :playerID";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':playerID', $playerID, PDO::PARAM_INT);
    $cmd->execute();
    $player = $cmd->fetch();
    $playerName = $player['playerName'];
    $playerAge = $player['playerAge'];
    $position = $player['position'];
    $photo = $player['photo'];
}
catch (Exception $err) {
    header('location:error.php');
    exit();
}

?>
<!-- edit player form -->
<h2>Edit Player Details</h2>
<form method="post" action="update-player.php" enctype="multipart/form-data">
    <!-- player name -->
    <fieldset>
        <label for="playerName">Name:</label>
        <input name="playerName" id="playerName" value="<?php echo $playerName; ?>" />
    </fieldset>
    <!-- age -->
    <fieldset>
        <label for="playerAge">Age:</label>
        <input name="playerAge" id="playerAge" value="<?php echo $playerAge; ?>" />
    </fieldset>
    <!-- position-->
    <fieldset>
        <label for="position">Position</label>
        <select name="position" id="position" required>
            <?php 
            // Assuming $db is your database connection object
            $sql = "SELECT positionName FROM positions";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $positionNames = $cmd->fetchAll(PDO::FETCH_ASSOC);
            
            // Loop through position names and populate dropdown
            foreach ($positionNames as $row) {
                $selected = ($row['positionName'] == $position) ? 'selected' : ''; // Check if the position matches the current player's position
                echo '<option value="' . $row['positionName'] . '"' . $selected . '>' . $row['positionName'] . '</option>';
            }
            ?>
        </select>
    </fieldset>

<!-- player photo-->
    <fieldset>
        <label for="photo">Photo:</label>
        <input type="file" name="newPhoto" id="newPhoto" accept="image/*"/>
        <!-- current player photo if there is one -->
        <input type="hidden" name="currentHeadshot" id="currentHeadshot" value="<?php echo $photo; ?>" />
        <?php 
        if ($photo != null) {
            echo '<img src="image/headshots/' . $photo . '" alt="Player Photo" />';
        } else {
            echo '<img src="image/headshots/defaultHeadshot.png" alt="Default Player Photo" />';
        }
        ?>
    </fieldset>
<!--hidden input to link to update-player.php -->
    <input type="hidden" name="playerId" id="playerId" value="<?php echo $playerId; ?>" />
    <button>Update Player</button>
    <?php
    $db = null;
    ?>
</form>
</main>
</body>
</html>
