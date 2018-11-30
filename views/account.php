<div class="container push-padding">
    <h2>Account details</h2>
    <hr>
    <h3>NAW gegevens wijzigen</h3>

    <?php
    if(count($errorMessages) >= 1) {
        foreach ($errorMessages as $value) {
            echo $value . "<br />";
        }
    }

    if(isset($changeSuccessful)) {
        echo $changeSuccessful . "<br />";
    }

    while ($row = $accountDetails->fetch()) {
        ?>
        <form action="account.php" method="post">
                Email:<br><input type="text" name="email" placeholder="Email" value="<?php if (!empty($row['email'])) {
            echo $row['email'];
        } ?>"><?php if(isset($_SESSION["legeNAW"])) { foreach($_SESSION["legeNAW"] as $item) { if($item == "email") { echo "<span class='requiredField'>* Vul dit veld in!</span>"; } } } ?><br>
                Voornaam:<br><input type="text" name="voornaam" placeholder="Voornaam" value="<?php if (!empty($row['voornaam'])) {
            echo $row['voornaam'];
        } ?>"><?php if(isset($_SESSION["legeNAW"])) { foreach($_SESSION["legeNAW"] as $item) { if($item == "voornaam") { echo "<span class='requiredField'>* Vul dit veld in!</span>"; } } } ?><br>
                Tussenvoegsels:<br><input type="text" name="tussenvoegsels" placeholder="Tussenvoegsels" value="<?php if (!empty($row['tussenvoegsels'])) {
            echo $row['tussenvoegsels'];
        } ?>"><br>
                Achternaam:<br><input type="text" name="achternaam" placeholder="Achternaam" value="<?php if (!empty($row['achternaam'])) {
            echo $row['achternaam'];
        } ?>"><?php if(isset($_SESSION["legeNAW"])) { foreach($_SESSION["legeNAW"] as $item) { if($item == "achternaam") { echo "<span class='requiredField'>* Vul dit veld in!</span>"; } } } ?><br><br><br>
                Straat:<br><input type="text" name="straat" placeholder="Straat" value="<?php if (!empty($row['straat'])) {
            echo $row['straat'];
        } ?>"><?php if(isset($_SESSION["legeNAW"])) { foreach($_SESSION["legeNAW"] as $item) { if($item == "straat") { echo "<span class='requiredField'>* Vul dit veld in!</span>"; } } } ?><br>
                Huisnummer:<br><input type="text" name="huisnummer" placeholder="Huisnummer" value="<?php if (!empty($row['huisnummer'])) {
            echo $row['huisnummer'];
        } ?>"><?php if(isset($_SESSION["legeNAW"])) { foreach($_SESSION["legeNAW"] as $item) { if($item == "huisnummer") { echo "<span class='requiredField'>* Vul dit veld in!</span>"; } } } ?><br>
                Woonplaats:<br><input type="text" name="woonplaats" placeholder="Woonplaats" value="<?php if (!empty($row['woonplaats'])) {
            echo $row['woonplaats'];
        } ?>"><?php if(isset($_SESSION["legeNAW"])) { foreach($_SESSION["legeNAW"] as $item) { if($item == "woonplaats") { echo "<span class='requiredField'>* Vul dit veld in!</span>"; } } } ?><br>
                Postcode:<br><input type="text" name="postcode" placeholder="Postcode" value="<?php if (!empty($row['postcode'])) {
            echo $row['postcode'];
        } ?>"><?php if(isset($_SESSION["legeNAW"])) { foreach($_SESSION["legeNAW"] as $item) { if($item == "postcode") { echo "<span class='requiredField'>* Vul dit veld in!</span>"; } } } ?><br>
                Telefoonnummer:<br><input type="number" name="telefoonnummer" placeholder="Telefoonnummer" value="<?php if (!empty($row['telefoonnummer'])) {
            echo $row['telefoonnummer'];
        } ?>"><br><br>
                <input type="submit" value="Submit" name="changeNAW">
            </form>
        <?php
    }
    unset($_SESSION["legeNAW"]);
?>

    <h3>Wachtwoord wijzigen</h3>
    <form action="account.php" method="post">
        Oud wachtwoord:<br><input type="password" name="oldPassword" placeholder="Old password" required><br>
        Nieuw wachtwoord:<br><input type="password" name="newPassword" placeholder="New password" required><br>
        Nieuw wachtwoord opnieuw:<br><input type="password" name="newPasswordAgain" placeholder="New password opnieuw" required><br><br>
        <input type="submit" value="Submit" name="changePW">
    </form>
</div>