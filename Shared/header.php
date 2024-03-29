<!--Shared Header-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Barrie RFC Coaches Portal'; ?></title>
    <link rel="stylesheet" href="./css/site.css" />
    <script src="./js/scripts.js" defer></script>
</head>
<body>
    <header id="globalNav">
        <nav class="navbar-container container" id="navbar-container">
        <h1 id="brand">Barrie RFC Coaches Portal</h1>
        <!-- Global Nav-->
        <ul id="pages">
            <li id="home-link"><a href="index.php">Home</a></li>
            <li id="view-team-link"><a href="veiw-team.php">View Team</a></li>
            <li id="deck-list-link"><a href="deck-list.php">This Week's Decklist</a>
            <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
              } 
            //check if user is logged in
            if (!empty($_SESSION['username'])) {
                echo '<li id="add-players-link"><a href="add-player.php">Add New Players</a></li>';
                echo '<li id="user-link"><a href="#">' . $_SESSION['username'] . '</a></li>
                <li id="logout-link"><a href="logout.php">Logout</a></li>';
            } else {
                //show login and register links
                echo '<li id="login-link"><a href="login.php">Login</a></li>
                <li id="register-link"><a href="register.php">Register</a></li>';
            }
            ?>
        </ul>
        </nav>
    </header>
    <main>

