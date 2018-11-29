<div class="container push-padding">
    <h2>Register</h2>
    <form action="register.php" method="post">
        <input type="text" name="username" placeholder="Username" value="<?php if (isset($username)) {
    echo $username;
} ?>" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="password" name="passwordCheck" placeholder="Password again" required><br>
        <input type="submit" value="Submit" name="register">
    </form>
</div>