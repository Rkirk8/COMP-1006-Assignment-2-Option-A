<?php
$title = 'Login';
require 'shared/header.php';
if (!empty($_GET['invalid'])) {
        echo '<h4>Password or Username is incorrect</h4>';
    }
?>
    <h2>Login</h2>
    <form method="post" action="validate-login.php">
        <fieldset>
            <label for="username">Username:</label>
            <input name="username" id="username" required type="email" placeholder="YourEmail@Domain.com" />
        </fieldset>
        <fieldset>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required />
        </fieldset>
        <button>Login</button>
    </form>
</main>
</body>
</html>