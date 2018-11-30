<div class="container push-padding" style="width: 520px; padding: 50px 20px;">

    <img src="assets/images/logo.png" class="img-fluid mx-auto d-block" alt="Logo" style="margin-bottom: 50px;">

    <form action="login.php" method="post">
        <div class="form-group">
            <label for="Username">Gebruikersnaam</label>
            <input type="Text" name="username" class="form-control" id="Username" placeholder="Gebruikersnaam" required>
        </div>
        <div class="form-group">
            <label for="Password">Wachtwoord</label>
            <input type="password" name="password" class="form-control" id="Password1" placeholder="Wachtwoord">
        </div>
        <button type="submit" value="Submit" name="login" class="btn btn-primary">Inloggen</button>
    </form>
    <?php
    if (count($errorMessages) >= 1) {
        foreach ($errorMessages as $value) {
            echo $value . "<br />";
        }
    }
    ?>
    <p>Heeft u nog geen account? Maak <a href="register.php">hier</a> uw account aan.</p>
</div>