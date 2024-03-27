<!--Shared Header-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo$title; ?></title>
    <link rel="stylesheet" href="./css/site.css" />
    <script src="./js/scripts.js" defer></script>
</head>
<body>
    <header id="globalNav">
        <nav class="navbar-container container">
        <h1>Barrie RFC Coaches Portal</h1>
        <!-- Global Nav-->
        <ol id="pages">
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="veiw-team.php">View Team</a>
            </li>
            <li>
                <a href="decklist.php">This Week's Decklist</a>
            <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (!empty($_SESSION['username'])) {
                echo '<li>
                    <a href="add-player.php">Add New Players</a>
                </li>';
            }
            if (!empty($_SESSION['username'])) {
                //show username and logout link
                echo '<li>
                    <a class="navbar-link" href="#">' . $_SESSION['username'] . '</a>
                </li>
                <li>
                    <a class="navbar-link" href="logout.php">Logout</a>
                </li>';
            } else {
                //show login and register links
                echo '<li>
                    <a class="navbar-link" href="login.php">Login</a>
                </li>
                <li>
                    <a class="navbar-link" href="register.php">Register</a>
                </li>';
            }
            ?>
        </ol>
        </nav>
    </header>
    <main>