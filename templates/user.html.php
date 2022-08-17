<p></p>
<?php if ($_SESSION["username"]==="admin"):?>
<h2>
    <a href="maintainCategory.php">Maintain Category</a>
</h2>
<h2>
    <a href="maintainItem.php">Maintain Item</a>
</h2>
<?php endif ?>

<h2>
    <a href="changePassword.php">Change password</a>
</h2>

<fieldset>
    <legend>Change background colour</legend>
    <div>
        <a href="user.php?theme=white">White</a>
        <a href="user.php?theme=pink">Pink</a>
        <a href="user.php?theme=yellow">Yellow</a>
        <a href="user.php?theme=green">Green</a>
        <a href="user.php?theme=blue">Blue</a>
    </div>
</fieldset>

