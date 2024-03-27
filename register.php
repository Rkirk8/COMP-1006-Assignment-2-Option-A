<?php 
$title = 'Register';    
include('shared/header.php'); 
?> 
<h2>Coach Register</h2>
<h5>Passwords must be a minimum of 8 characters, including 1 digit, 1 upper-case letter, and 1 lower-case letter.</h5>

<form method="post" action="save-user.php">
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
        onkeyup="return compPasswords();"
        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
    </fieldset>

    <button onclick="return compPasswords();">Register</button>

</form>
</main>
</body>
</html>