<div class="container push-padding">
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
                Email:<br><input type="text" name="email" placeholder="Email" value="<?php if (!empty($row['email'])) {
            echo $row['email'];
        } ?>"><br>
                Voornaam:<br><input type="text" name="voornaam" placeholder="Voornaam" value="<?php if (!empty($row['voornaam'])) {
            echo $row['voornaam'];
        } ?>"><br>
                Tussenvoegsels:<br><input type="text" name="tussenvoegsels" placeholder="Tussenvoegsels" value="<?php if (!empty($row['tussenvoegsels'])) {
            echo $row['tussenvoegsels'];
        } ?>"><br>
                Achternaam:<br><input type="text" name="achternaam" placeholder="Achternaam" value="<?php if (!empty($row['achternaam'])) {
            echo $row['achternaam'];
        } ?>"><br>
                Straat:<br><input type="text" name="straat" placeholder="Straat" value="<?php if (!empty($row['straat'])) {
            echo $row['straat'];
        } ?>"><br>
                Huisnummer:<br><input type="text" name="huisnummer" placeholder="Huisnummer" value="<?php if (!empty($row['huisnummer'])) {
            echo $row['huisnummer'];
        } ?>"><br>
                Woonplaats:<br><input type="text" name="woonplaats" placeholder="Woonplaats" value="<?php if (!empty($row['woonplaats'])) {
            echo $row['woonplaats'];
        } ?>"><br>
                Postcode:<br><input type="text" name="postcode" placeholder="Postcode" value="<?php if (!empty($row['postcode'])) {
            echo $row['postcode'];
        } ?>"><br>
                Telefoonnummer:<br><input type="number" name="telefoonnummer" placeholder="Telefoonnummer" value="<?php if (!empty($row['telefoonnummer'])) {
            echo $row['telefoonnummer'];
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