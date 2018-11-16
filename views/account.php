<div class="container">
    <h2>Account details</h2>
    <hr>
    <h3>NAW gegevens wijzigen</h3>

    <?php
    if (count($errorMessages) >= 1) {
        foreach ($errorMessages as $value) {
            echo $value . "<br />";
        }
    }

    if (isset($changeSuccessful)) {
        echo $changeSuccessful . "<br />";
    }

    while ($row = $accountDetails->fetch()) {
        ?>
        <form action="account.php" method="post">
            Naam:<br><input type="text" name="naam" placeholder="Naam" value="<?php if (!empty($row['naam'])) {
        echo $row['naam'];
    } ?>"><br>
            Adres:<br><input type="text" name="adres" placeholder="Adres" value="<?php if (!empty($row['adres'])) {
        echo $row['adres'];
    } ?>"><br>
            Woonplaats:<br><input type="text" name="woonplaats" placeholder="Woonplaats" value="<?php if (!empty($row['woonplaats'])) {
        echo $row['woonplaats'];
    } ?>"><br>
            <input type="submit" value="Submit" name="changeNAW">
        </form>
    <?php
}
?>

    <h3>Wachtwoord wijzigen</h3>
    <form action="account.php" method="post">
        Oud wachtwoord:<br><input type="password" name="oldPassword" placeholder="Old password" required><br>
        Nieuw wachtwoord:<br><input type="password" name="newPassword" placeholder="New password" required><br>
        Nieuw wachtwoord opnieuw:<br><input type="password" name="newPasswordAgain" placeholder="New password opnieuw" required><br>
        <input type="submit" value="Submit" name="changePW">
    </form>
</div>