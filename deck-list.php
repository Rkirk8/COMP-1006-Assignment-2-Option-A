<?php 
$title = 'This Weeks DeckList';
include('Shared/header.php');
//dynamic table populated from db
include ('Shared/database.php');
// get data from decklist and the players photo from players
//Update decklist positions based on starterspots
$sql = "UPDATE decklist AS d
JOIN starterspots AS s ON d.starterID = s.spotID
SET d.position = s.starterSpotName;
UPDATE decklist AS d
JOIN players AS p ON d.playerName = p.playerName
SET d.playerphoto = p.photo;
SELECT d.starterID, d.position, d.playerName, d.playerphoto
FROM decklist 
ORDER BY starterID;";
$cmd = $db->prepare($sql);
$cmd->execute();
$data = $cmd->fetchAll();
// build table
echo '<h1>The Starting 15 for this Weekend are the following</h1>';
echo '<table>
    <thead>
        <th>Position</th>
        <th>Player</th>
        <th>Photo</th>
    </thead>';
// loop through data
foreach ($data as $row) {
    echo '<tr>
    <td>' . $row['position'] . '</td>
    <td>' . $row['playerName'] . '</td>
    <td>';
        if ($row['playerphoto'] != null) { 
        echo '<img src="img/uploads/' . $row['playerphoto'] . '" class="thumbnail" />'; 
    } 
    echo '</td>';
}
echo '</table>';
// close connection
$db = null;
//button for logged in users to set decklist
if (!empty($_SESSION['username'])) {
        echo '<button><a href="Set-decklist.php">Set Your Decklist</a></button>';
    }
?>
</body>
</html>