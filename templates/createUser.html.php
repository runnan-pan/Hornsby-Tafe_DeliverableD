<h2>Create staff account</h2>

<div class="login-wrapper">
    <form action="createUser.php" method="POST">
        <fieldset>
            <legend>Create an account</legend>        
            <p>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?=$formValidation->setValue("username")?>">
                <span class="error-message"><?=$usernameMsg?></span>

            </p>
            <p>
                <label for="password1">Password:</label>
                <input type="password" id="password1" name="password1" value="">
                <span class="error-message"><?=$password1Msg?></span>

            </p>
            <p>
                <label for="password2">Re-type password:</label>
                <input type="password" id="password2" name="password2" value="">
                <span class="error-message"><?=$password2Msg?></span>
            </p>
            <p>
                <input type="submit" name="submit" value="Submit">
                <span class="error-message"><?=$message?></span>
            </p>
            <a href="login.php">Login if you have an account</a>
        </fieldset>
    </form>
</div>