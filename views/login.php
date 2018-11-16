<div class="container">
    <h2>Login</h2>
    <form action="login.php" method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Submit" name="login">
    </form>
    <?php
    if (count($errorMessages) >= 1) {
        foreach ($errorMessages as $value) {
            echo $value . "<br />";
        }
    }
    ?>
</div>