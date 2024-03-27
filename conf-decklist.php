<?php
include('shared/auth.php');
$title = 'Saving New Show...';
include('shared/header.php');
// capture form inputs into vars
$LooseHeadProp = $_POST['looseHead'];
$Hooker = $_POST['hooker'];
$TightHeadProp = $_POST['tightHead'];
$Lock4 = $_POST['lock4'];
$Lock5 = $_POST['lock5'];
$blindFlanker = $_POST['blindFlanker'];
$openFlanker = $_POST['openFlanker'];
$Num8 = $_POST['number8'];
$Scrummy = $_POST['scrumHalf'];
$Fly = $_POST['flyHalf'];
$bWing = $_POST['blindWing'];
$inCent = $_POST['inCentre'];
$outCent = $_POST['outCentre'];
$oWing = $_POST['openWing'];
$fullB = $_POST['fullBack'];
$ok = true;

// validation to make sure no duplicate players where applicable
if ($LooseHeadProp == $TightHeadProp) {
    echo 'You cannot have the same player for both Props';
    $ok = false;
}
if ($Lock5 == $Lock4) {
    echo 'You cannot have the same player for both Locks';
    $ok = false;
}
if ($blindFlanker == $openFlanker) {
    echo 'You cannot have the same player for both Flankers';
    $ok = false;
}
if ($bWing == $oWing) {
    echo 'You cannot have the same player for both Wings';
    $ok = false;
}
if ($inCent == $outCent) {
    echo 'You cannot have the same player for both Centre';
    $ok = false;
}
if ($ok == true) {
    try {
    // connect to database
    include('shared/database.php');

    // save to database
    $sql = "INSERT INTO decklist (playerName)
    VALUES
    (':tightHead'), (':hooker'), (':looseHead'), (':lock4'), (':lock5'), (':blindFlank'), (':openFlank'), (':number8'), (':scrumHalf'), (':flyHalf'), (':blinkWing'), (':inCenter'), (':outCenter'), (':openWing'), (':fullBack')"; 
    $stmt = $db->prepare($sql);
    //map each input to a column in the decklist table
    $stmt->bindValue(':tightHead', $TightHeadProp, PDO::PARAM_STR, 100);
    $stmt->bindValue(':hooker', $Hooker, PDO::PARAM_STR, 100);
    $stmt->bindValue(':looseHead', $LooseHeadProp, PDO::PARAM_STR, 100);
    $stmt->bindValue(':lock4', $Lock4, PDO::PARAM_STR, 100);
    $stmt->bindValue(':lock5', $Lock5, PDO::PARAM_STR, 100);
    $stmt->bindValue(':blindFlank', $blindFlanker, PDO::PARAM_STR, 100);
    $stmt->bindValue(':openFlank', $openFlanker, PDO::PARAM_STR, 100);
    $stmt->bindValue(':number8', $Num8, PDO::PARAM_STR, 100);
    $stmt->bindValue(':scrumHalf', $Scrummy, PDO::PARAM_STR, 100);
    $stmt->bindValue(':flyHalf', $Fly, PDO::PARAM_STR, 100);
    $stmt->bindValue(':blinkWing', $bWing, PDO::PARAM_STR, 100);
    $stmt->bindValue(':inCenter', $inCent, PDO::PARAM_STR, 100);
    $stmt->bindValue(':outCenter', $outCent, PDO::PARAM_STR, 100);
    $stmt->bindValue(':openWing', $oWing, PDO::PARAM_STR, 100);
    $stmt->bindValue(':fullBack', $fullB, PDO::PARAM_STR, 100);
    //execute
    $stmt->execute();
    //disconnect
    $db = null;
    //show user a success message
    echo 'Your Starting 15 has been saved successfully<br />
    GoodLuck!';
    } catch (Exception $err) {
        header('location:error.php');
        exit();
    }
}
?>
</main>
</body>
</html>
