<?php 
$title = 'Register';    
include('Shared/header.php'); 
?>
<h2>Coach Register</h2>
<h5 id="password-requirements">Passwords must be a minimum of 8 characters, including 1 digit, 1 upper-case letter, and 1 lower-case letter.</h5>

<form method="post" action="save-user.php" id="register-form">
    <fieldset>
        <label for="username">email:</label>
        <input name="username" id="username" required type="email" placeholder="youremail@domain.com" />
    </fieldset>

    <fieldset>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
    </fieldset>

    <fieldset>
        <label for="confirm">Confirm Password:</label>
        <input type="password" name="confirm" id="confirm" required
            onkeyup="checkPasswords();" />
    </fieldset>

    <button onclick="return checkPasswords();" id="register-button">Register</button>

</form>
</main>
</body>
</html>

