<!--Shared Header-->
<?php
$title = 'Add New Player';
include('Shared/header.php');
?>
        <h1>Add New player</h1>
        <!-- form for player name, age, position -->
        <form method="post" action="player-saved.php">
            <fieldset>
                <label for="playerName">Name: </label>
                <input name="playerName" id="playerName" placeholder="First Last" required/>
            </fieldset>
            <fieldset>
                <label for="playerAge">Age: </label>
                <input name="playerAge" id="playerAge" type="number" min="18" max="70"/>
            </fieldset>
            <!--Dropdown menu populated from the database-->
            <fieldset>
                <label for="playerPosition">Position: </label>
                <select name="playerPosition" id="playerPosition" placeholder="Click me for dropdown" required>
                    <?php
                        include ('Shared/database.php');
                        $sql = "SELECT positionName FROM positions";
                        $result = $db->query($sql);
                        foreach($result as $row){
                            echo '<option value="' . $row['positionName'] . '">' . $row['positionName'] . '</option>';
                        };
                        $db = null;
                    ?>
                </select>
            </fieldset>
            <fieldset>
                <label for="playerPhoto">Photo: </label>
                <input type="file" name="playerPhoto" id="photo" accept="image/*"/>
            </fieldset>
            <!--submit button-->
            <fieldset>
                <button>Add New Player</button>
            </fieldset>
        </form>
    </body>
</html>