<?php 
$title = 'Edit Show';
include('shared/header.php'); 
include('shared/auth.php');

//get playerId
$playerId = $_GET['playerId'];

//init variables
$playerName = null;
$playerAge = null;
$position = null;
// fetch playerId if numeric 
if (is_numeric($playerId)) {
    try {
        //connect to db
        include('shared/db.php');
        // query and populate player properties
        $sql = "SELECT * FROM players WHERE playerId = :playerId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':playerId', $playerId, PDO::PARAM_INT);
        $cmd->execute();
        $player = $cmd->fetch();

        $playerName = $player['playerName'];
        $playerAge = $player['playerAge'];
        $position = $player['position'];
        $photo = $player['photo'];
        //catch error and redirect 
    }
    catch (Exception $err) {
        header('location:error.php');
        exit();
    }
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
        <!-- set up & run query to update player in db -->
            <?php 
            $sql = "SELECT positionName FROM positions";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $positionName = $cmd->fetchAll();
            // loop positions and populate dropdown 1 at a time then select position that matches players current position
            foreach ($positionName as $position) {
                if ($position['positionName'] == $position) {
                    echo '<option selected value="' . $position['positionName'] . '">' . $position['positionName'] . '</option>';
                }
                else {
                    echo '<option value="' . $position['positionName'] . '">' . $position['positionName'] . '</option>';
                }
            }
            // disconnect 
            $db = null;
            ?>
        </select>
    </fieldset>
<!-- player photo-->
    <fieldset>
        <label for="photo">Photo:</label>
        <input type="file" name="photo" id="photo" accept="image/*"/>
        <!-- current player photo if there is one -->
        <input type="hidden" name="currentHeadshot" id="currentHeadshot" value="<?php echo $photo; ?>" />
        <?php 
        if ($photo != null) {
            echo '<img src="image/headshots/defultHeadshot.png' . $photo . '" alt="Default Player Photo" />';
        }
        ?>
    </fieldset>
<!--hidden input to link to update-player.php -->
    <input type="hidden" name="playerId" id="playerId" value="<?php echo $playerId; ?>" />
    <button>Update Player</button>
</form>
</main>
</body>
</html>
