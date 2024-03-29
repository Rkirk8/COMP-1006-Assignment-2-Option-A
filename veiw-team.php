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
echo '<table>
        <thead>
            <th>Name</th>
            <th>Age</th>
            <th>Position</th>
            <th>Photo</th>';
if (!empty($_SESSION['username'])) {
    echo '<th>Actions</th>';
}
echo '</thead>';

// Loop through data
foreach ($data as $row) {
    echo '<tr>
            <td>' . $row['playerName'] . '</td>
            <td>' . $row['playerAge'] . '</td>
            <td>' . $row['position'] . '</td>
            <td>'; 
    echo '<img src="image/headshots/' . $row['photo'] . '" class="thumbnail" />'; 
    echo '</td>'; 
    if (!empty($_SESSION['username'])) {
        echo '<td class="actions">
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

include('Shared/footer.php'); // Assuming you have a footer include
?>
