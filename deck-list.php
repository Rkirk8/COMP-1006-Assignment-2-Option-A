<?php 
$title = 'This Weeks DeckList';
include('Shared/header.php');
//dynamic table populated from db
include ('Shared/db.php');
echo "<script>console.log('db = go');</script>";
// get data from decklist and the players photo from players
//Update decklist positions based on starterspots
$sql = "UPDATE decklist AS d
JOIN starterspots AS s ON d.starterID = s.spotID
SET d.position = s.starterSpotName;";
$command = $db->prepare($sql);
echo "<script>console.log('sql = go');</script>";
$command->execute();

$sndsql = "UPDATE decklist AS d
JOIN players AS p ON d.playerName = p.playerName
SET d.playerphoto = p.photo;";
$com = $db->prepare($sndsql);
echo "<script>console.log('sndsql = go');</script>";
$com->execute();

$ThrdSql = "UPDATE decklist AS d
JOIN starterspots AS s ON d.position = s.starterSpotName
SET d.positionName = s.positionName;";
$cmd = $db->prepare($ThrdSql);
echo "<script>console.log('ThrdSql = go');</script>";
$cmd->execute();


$fnlsql = "SELECT *FROM decklist 
ORDER BY starterID;";
$cmd = $db->prepare($fnlsql);
echo "<script>console.log('fnlsql = go');</script>";
$cmd->execute();

$data = $cmd->fetchAll();
// build table
echo '<h2 id="starting-lineup-header">The Starting 15 for this Weekend are the following</h2>';
echo '<table id="starting-lineup-table">
        <thead>
            <tr>
                <th id="position-column-header">Position</th>
                <th id="player-column-header">Player</th>
                <th id="photo-column-header">Photo</th>
            </tr>
        </thead>';
// loop through data
foreach ($data as $row) {
    echo '<tr id="starting-lineup-row">
        <td id="position-cell">' . $row['positionName'] . '</td>
        <td id="player-cell">' . $row['playerName'] . '</td>';
        
            if ($row['playerphoto'] != null) { 
            echo '<td id="photo-cell">' . '<img src="image/headshots/' . $row['playerphoto'] . '" />' . '</td>'; 
        } 
    echo '</tr>';
}
echo '</table>';
// close connection
$db = null;
//button for logged in users to set decklist
if (!empty($_SESSION['username'])) {
        echo '<button><a href="Set-decklist.php">Set Your Decklist</a></button>';
    }
?>
</main>
</body>
</html>
