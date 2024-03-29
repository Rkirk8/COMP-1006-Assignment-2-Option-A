<!-- Global header -->
<?php
$title = 'View Team';
include('Shared/header.php');

// Include database connection
include('Shared/db.php');

// Fetch data from the database
$sql = "SELECT * FROM players ORDER BY playerName";
$cmd = $db->prepare($sql);
$cmd->execute();
$data = $cmd->fetchAll();

// Build the table
echo '<h1>View Full Team</h1>';
echo '<table id="view-team-table">
        <thead>
            <tr>
                <th id="name-column-header">Name</th>
                <th id="age-column-header">Age</th>
                <th id="position-column-header">Position</th>
                <th id="photo-column-header">Photo</th>';
if (!empty($_SESSION['username'])) {
    echo '<th id="actions-column-header">Actions</th>';
}
echo '</tr></thead>';

// Loop through data
foreach ($data as $row) {
    echo '<tr>
            <td id="name-cell">' . $row['playerName'] . '</td>
            <td id="age-cell">' . $row['playerAge'] . '</td>
            <td id="position-cell">' . $row['position'] . '</td>
            <td id="photo-cell">'; 
    echo '<img src="image/headshots/' . $row['photo'] . '" class="thumbnail" />'; 
    echo '</td>'; 
    if (!empty($_SESSION['username'])) {
        echo '<td id="actions-cell" class="actions">
                <a href="edit-player.php?playerID=' . $row['playerID'] . '">
                    Edit
                </a>&nbsp;
                <a href="delete-player.php?playerID=' .$row['playerID'] . '" onclick="return confirmDelete();">
                    Delete
                </a>
            </td>
        </tr>';
    } else {
        echo'</tr>';
    }
} 

echo '</table>';

// Close the database connection
$db = null;

if (empty($_SESSION['username'])) { 
    echo '<button><a href="add-player.php">Add New Player</a></button>';
}
?>
</main>
</body>
</html>
