<!-- Global header -->
<?php
$title = 'View Team';
include('Shared/header.php');
//dynamic table populated from db
        include ('Shared/database.php');
        //get data from players and positions and group all by positionID with INNER JOIN and ORDER BY
        $sql = "SELECT players.playerName, players.playerAge, players.position, positions.jerseyNum, positions.positionID 
        FROM players
        INNER JOIN positions ON players.position = positions.positionName
        ORDER BY positionID;";
        $cmd = $db->prepare($sql);
        $cmd->execute();
        $data = $cmd->fetchAll();
        // build table
        echo '<h1> View Full Team</h1>';
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
        // loop through data
        foreach($data as $row){
            echo '<tr>
            <td>' . $row['playerName'] . '</td>
            <td>' . $row['playerAge'] . '</td>
            <td>' . $row['position'] . '</td>
            <td>';
                if ($row['photo'] != null) { 
                echo '<img src="img/uploads/' . $row['photo'] . '" class="thumbnail" />'; 
            } 
            echo '</td>'; 
            echo '</tr>';
            if (!empty($_SESSION['username'])) {
                echo '<td class="actions">
                    <a href="edit-player.php?playerId=' .$row['playerId'] . '">
                        Edit
                    </a>&nbsp;
                    <a href="delete-player.php?playerId=' .$row['playerId'] . '" onclick="return confirmDelete();">
                        Delete
                    </a>
                </td>
                </tr>';
            }
        }
        echo '</table>';
        // close connection
        $db = null;
        if (empty($_SESSION['username'])) { 
        echo '<button><a href="add-player.php">Add New Player</a></button>';
        }
    echo '</table>';
    ?>
</body>
</html>