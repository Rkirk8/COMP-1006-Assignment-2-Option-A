<?php
$title = 'Create Decklist';
include('Shared/header.php');

// Database connection
include('Shared/db.php');
?>
<h2>Create This Weeks Starting Lineup</h2>
    <form method="post" action="conf-decklist.php" id ="decklist-form">
        <fieldset>
            <label for="looseHead">Loose Head Prop</label>
            <select name="looseHead" id="looseHead" required>
                <?php
                // fetch only players with position "Prop"
                $sql = "SELECT playerName FROM players WHERE position = 'Prop'";
                $result = $db->query($sql);
                foreach ($result as $prop) {
                    echo '<option value="' . $prop['playerName'] . '">' . $prop['playerName'] . '</option>';
                }
                ?>
            </select>
        </fieldset>
        <fieldset>
            <label for="hooker">Hooker</label>
            <select name="hooker" id="hooker" required>
                <?php
                // fetch only players with position "Hooker"
                $sql = "SELECT playerName FROM players WHERE position = 'Hooker'";
                $result = $db->query($sql);
                foreach ($result as $hooker) {
                    echo '<option value="' . $hooker['playerName'] . '">' . $hooker['playerName'] . '</option>';
                }
                ?>
            </select>
        </fieldset>
        <fieldset>
            <label for="tightHead">Tight Head Prop</label>
            <select name="tightHead" id="tightHead" required>
                <?php
                $sql = "SELECT playerName FROM players WHERE position = 'Prop'";
                $result = $db->query($sql);
                foreach ($result as $prop) {
                    echo '<option value="' . $prop['playerName'] . '">' . $prop['playerName'] . '</option>';
                }
                ?>
            </select>
        </fieldset>
        <fieldset>
            <label for="lock4">#4 Lock </label>
            <select name="lock4" id="lock4" required>
                <?php
                // fetch only players with position "Lock"
                $sql = "SELECT playerName FROM players WHERE position = 'Lock'";
                $result = $db->query($sql);
                foreach ($result as $lock) {
                    echo '<option value="' . $lock['playerName'] . '">' . $lock['playerName'] . '</option>';
                }
                ?>
            </select>
        </fieldset>
        <fieldset>
            <label for="lock5">#5 Lock</label>
            <select name="lock5" id="lock5" required>
                <?php
                // fetch only players with position "lock"
                $sql = "SELECT playerName FROM players WHERE position = 'Lock'";
                $result = $db->query($sql);
                foreach ($result as $lock) {
                    echo '<option value="' . $lock['playerName'] . '">' . $lock['playerName'] . '</option>';
                }
                ?>
            </select>
        </fieldset>
        <fieldset>
            <label for="blindFlank">Blindside Flanker</label>
            <select name="blindFlank" id="blindFlank" required>
                <?php
                // fetch only players with position "Flanker"
                $sql = "SELECT playerName FROM players WHERE position = 'Flanker'";
                $result = $db->query($sql);
                foreach ($result as $flank) {
                    echo '<option value="' . $flank['playerName'] . '">' . $flank['playerName'] . '</option>';
                }
                ?>
            </select>
        </fieldset>
        <fieldset>
            <label for="openFlank">Open-side Flanker</label>
            <select name="openFlank" id="openFlank" required>
                <?php
                $sql = "SELECT playerName FROM players WHERE position = 'Flanker'";
                $result = $db->query($sql);
                foreach ($result as $flank) {
                    echo '<option value="' . $flank['playerName'] . '">' . $flank['playerName'] . '</option>';
                }
                ?>
            </select>
        </fieldset>
        <fieldset>
            <label for="number8">Number8</label>
            <select name="number8" id="number8" required>
                <?php
                // fetch only players with position "Number 8"
                $sql = "SELECT playerName FROM players WHERE position = 'Number 8'";
                $result = $db->query($sql);
                foreach ($result as $num8) {
                    echo '<option value="' . $num8['playerName'] . '">' . $num8['playerName'] . '</option>';
                }
                ?>
            </select>
        </fieldset>
        <fieldset>
            <label for="scrumHalf">Scrum Half</label>
            <select name="scrumHalf" id="scrumHalf" required>
                <?php
                // fetch only players with position "Scrum Half"
                $sql = "SELECT playerName FROM players WHERE position = 'Scrum Half'";
                $result = $db->query($sql);
                foreach ($result as $scrummy) {
                    echo '<option value="' . $scrummy['playerName'] . '">' . $scrummy['playerName'] . '</option>';
                }
                ?>
            </select>
        </fieldset>
        <fieldset>
            <label for="flyHalf">Fly Half</label>
            <select name="flyHalf" id="flyHalf" required>
                <?php
                // fetch only players with position "Fly Half"
                $sql = "SELECT playerName FROM players WHERE position = 'Fly Half'";
                $result = $db->query($sql);
                foreach ($result as $flyHalf) {
                    echo '<option value="' . $flyHalf['playerName'] . '">' . $flyHalf['playerName'] . '</option>';
                }
                ?>
            </select>
        </fieldset>
        <fieldset>
            <label for="blindWing">Blindside Winger</label>
            <select name="blindWing" id="blindWing" required>
                <?php
                // fetch only players with position "Winger"
                $sql = "SELECT playerName FROM players WHERE position = 'Winger'";
                $result = $db->query($sql);
                foreach ($result as $wing) {
                    echo '<option value="' . $wing['playerName'] . '">' . $wing['playerName'] . '</option>';
                }
                ?>
            </select>
        </fieldset>
        <fieldset>
            <label for="inCenter">Inside Centre</label>
            <select name="inCenter" id="inCenter" required>
                <?php
                $sql = "SELECT playerName FROM players WHERE position = 'Center'";
                $result = $db->query($sql);
                foreach ($result as $wing) {
                    echo '<option value="' . $wing['playerName'] . '">' . $wing['playerName'] . '</option>';
                }
                ?>
            </select>
        </fieldset>
        <fieldset>
            <label for="outCenter">Outside Centre</label>
            <select name="outCenter" id="outCenter" required>
                <?php
                $sql = "SELECT playerName FROM players WHERE position = 'Center'";
                $result = $db->query($sql);
                foreach ($result as $cent) {
                    echo '<option value="' . $cent['playerName'] . '">' . $cent['playerName'] . '</option>';
                }
                ?>
            </select>
        </fieldset>
        <fieldset>
            <label for="openWing">Open-side Winger</label>
            <select name="openWing" id="openWing" required>
                <?php
                $sql = "SELECT playerName FROM players WHERE position = 'Winger'";
                $result = $db->query($sql);
                foreach ($result as $wing) {
                    echo '<option value="' . $wing['playerName'] . '">' . $wing['playerName'] . '</option>';
                }
                ?>
            </select>
        </fieldset>
        <fieldset>
            <label for="fullBack">Full Back</label>
            <select name="fullBack" id="fullBack" required>
                <?php
                // fetch only players with position "Full Back"
                $sql = "SELECT playerName FROM players WHERE position = 'Full Back'";
                $result = $db->query($sql);
                foreach ($result as $fullBack) {
                    echo '<option value="' . $fullBack['playerName'] . '">' . $fullBack['playerName'] . '</option>';
                }
                // close database connection
                $db = null;
                ?>
            </select>
        </fieldset>
        <!--submit button-->
        <fieldset>
            <button>Submit</button>
            <p>Submit this weeks starting lineup</p>
        </fieldset>
    </form>
    </main>
    </body>
</html>