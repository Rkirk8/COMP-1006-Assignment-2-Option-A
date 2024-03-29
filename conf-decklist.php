<?php
include('Shared/auth.php');
$title = 'Saving Starting Lineup';
include('Shared/header.php');
// capture form inputs into vars
$LooseHeadProp = $_POST['looseHead'];
$Hooker = $_POST['hooker'];
$TightHeadProp = $_POST['tightHead'];
$Lock4 = $_POST['lock4'];
$Lock5 = $_POST['lock5'];
$blindFlanker = $_POST['blindFlank'];
$openFlanker = $_POST['openFlank'];
$Num8 = $_POST['number8'];
$Scrummy = $_POST['scrumHalf'];
$Fly = $_POST['flyHalf'];
$bWing = $_POST['blindWing'];
$inCent = $_POST['inCenter'];
$outCent = $_POST['outCenter'];
$oWing = $_POST['openWing'];
$fullB = $_POST['fullBack'];


// validation to make sure no duplicate players where applicable
if ($LooseHeadProp == $TightHeadProp || $Lock4 == $Lock5 || $blindFlanker == $openFlanker || $bWing == $oWing || $inCent == $outCent) {
    echo 'You cannot have one player playing more then one position';
    $ok = false;
} else {
    $ok = true;
    echo '<script>console.log("Valid");</script>';
}

if ($ok == true) {
    try {
        // connect to database
        include('Shared/db.php');
        echo '<script>console.log("Connected");</script>';
        // save to database
        /*original sql to create the table 
        $sql = "INSERT INTO decklist (playerName)
        VALUES
         (:tightHead), (:hooker), (:looseHead), (:lock4), (:lock5), (:blindFlank), (:openFlank), (:number8), (:scrumHalf), (:flyHalf), (:blindWing), (:inCenter), (:outCenter), (:openWing), (:fullBack)";*/
         //new query to update table based off the positions
         $sql = "UPDATE decklist
         SET 
             playerName = CASE position
                 WHEN 'tightHead' THEN :tightHead
                 WHEN 'hooker' THEN :hooker
                 WHEN 'looseHead' THEN :looseHead
                 WHEN 'lock4' THEN :lock4
                 WHEN 'lock5' THEN :lock5
                 WHEN 'blindFlank' THEN :blindFlank
                 WHEN 'openFlank' THEN :openFlank
                 WHEN 'number8' THEN :number8
                 WHEN 'scrumHalf' THEN :scrumHalf
                 WHEN 'flyHalf' THEN :flyHalf
                 WHEN 'blindWing' THEN :blindWing
                 WHEN 'inCenter' THEN :inCenter
                 WHEN 'outCenter' THEN :outCenter
                 WHEN 'openWing' THEN :openWing
                 WHEN 'fullBack' THEN :fullBack
                 ELSE playerName
             END;
         "; 
        $stmt = $db->prepare($sql);
        //map each input to a column in the decklist table
        $stmt->bindParam(':looseHead', $LooseHeadProp, PDO::PARAM_STR, 100);
        $stmt->bindParam(':hooker', $Hooker, PDO::PARAM_STR, 100);
        $stmt->bindParam(':tightHead', $TightHeadProp, PDO::PARAM_STR, 100);
        $stmt->bindParam(':lock4', $Lock4, PDO::PARAM_STR, 100);
        $stmt->bindParam(':lock5', $Lock5, PDO::PARAM_STR, 100);
        $stmt->bindParam(':blindFlank', $blindFlanker, PDO::PARAM_STR, 100);
        $stmt->bindParam(':openFlank', $openFlanker, PDO::PARAM_STR, 100);
        $stmt->bindParam(':number8', $Num8, PDO::PARAM_STR, 100);
        $stmt->bindParam(':scrumHalf', $Scrummy, PDO::PARAM_STR, 100);
        $stmt->bindParam(':flyHalf', $Fly, PDO::PARAM_STR, 100);
        $stmt->bindParam(':blindWing', $bWing, PDO::PARAM_STR, 100);
        $stmt->bindParam(':inCenter', $inCent, PDO::PARAM_STR, 100);
        $stmt->bindParam(':outCenter', $outCent, PDO::PARAM_STR, 100);
        $stmt->bindParam(':openWing', $oWing, PDO::PARAM_STR, 100);
        $stmt->bindParam(':fullBack', $fullB, PDO::PARAM_STR, 100);
        //execute
        $stmt->execute();
        //disconnect
        $db = null;
        //show user a success message
        echo 'Your Starting 15 has been saved successfully<br />
        GoodLuck!';
    } catch (Exception $err) {
        header('location:error.php');
        $db = null;
        echo 'Error: ' . $err;
    }
}
?>
</main>
</body>
</html>
