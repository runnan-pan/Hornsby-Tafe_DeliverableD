<h2>Change password</h2>

<div class="login-wrapper">
    <form action="changePassword.php" method="POST">
        <fieldset>
            <legend>Change your password</legend>        
            <p>
                <label for="password0">Old password:</label>
                <input type="password" id="password0" name="password0">
                <span class="error-message"></span>
            </p>
            <p>
                <label for="password1">New password:</label>
                <input type="password" id="password1" name="password1">
                <span class="error-message"></span>

            </p>
            <p>
                <label for="password2">Re-type new password:</label>
                <input type="password" id="password2" name="password2">
                <span class="error-message"></span>
            </p>
            <p>
                <input type="submit" name="submit" value="Submit">
                <span class="error-message"><?=$message?></span>
            </p>
        </fieldset>
    </form>
</div>