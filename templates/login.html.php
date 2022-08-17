<h2>Staff login</h2>

<div class="login-wrapper">
    <form action="login.php" method="POST">
        <fieldset>
            <legend>Login</legend>        
            <p>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="">
            </p>
            <p>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="">
            </p>
            <p>
                <input type="submit" name="submit" value="Submit"><span><?=$message?></span>
            </p>
            <p>
                <a href="createUser.php">Create User</a>
            </p>
        </fieldset>
    </form>
</div>