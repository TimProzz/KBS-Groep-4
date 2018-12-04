<?php

include_once "package.inc.php";
$views = "views/account.php";
?>

<?php

if (!isset($_COOKIE["login"])) {
    header("Location: index.php?error=You need to be logged in to visit this page!");
    exit;
}

$errorMessages = array();

$accountDetails = $pdo->prepare("SELECT * FROM users WHERE username = '" . $_COOKIE['login'] . "'");
$accountDetails->execute();
$row = $accountDetails->fetch();
$userOrders = $pdo->query("SELECT * FROM get_order WHERE customerID = '" . $row["id"] . "' ORDER BY id DESC");

if (isset($_POST["changeNAW"])) {
    $email = $_POST["email"];
    $voornaam = $_POST["voornaam"];
    $tussenvoegsels = $_POST["tussenvoegsels"];
    $achternaam = $_POST["achternaam"];
    $straat = $_POST["straat"];
    $huisnummer = $_POST["huisnummer"];
    $woonplaats = $_POST["woonplaats"];
    $postcode = $_POST["postcode"];
    $telefoonnummer = $_POST["telefoonnummer"];

    try {
        $query = $pdo->prepare("UPDATE users SET email = :email, voornaam = :voornaam, tussenvoegsels = :tussenvoegsels, achternaam = :achternaam, straat = :straat, huisnummer = :huisnummer, woonplaats = :woonplaats, postcode = :postcode, telefoonnummer = :telefoonnummer WHERE username = '" . $_COOKIE['login'] . "'");
        $query->bindValue(':email', $email);
        $query->bindValue(':voornaam', $voornaam);
        $query->bindValue(':tussenvoegsels', $tussenvoegsels);
        $query->bindValue(':achternaam', $achternaam);
        $query->bindValue(':straat', $straat);
        $query->bindValue(':huisnummer', $huisnummer);
        $query->bindValue(':woonplaats', $woonplaats);
        $query->bindValue(':postcode', $postcode);
        $query->bindValue(':telefoonnummer', $telefoonnummer);
        $query->execute();

        header("Location: account.php?success=You've successfully changed your NAW details!");
        exit;
    } catch (Exception $e) {
        echo "Failed to change user details: " . $e->getMessage();
    }
}

if (isset($_POST["changePW"])) {
    $oldPW = $_POST["oldPassword"];
    $newPW = $_POST["newPassword"];
    $newPwAgain = $_POST["newPasswordAgain"];
    $username = $_COOKIE["login"];

    //while ($row = $accountDetails->fetch()) {
    $passwordDB = $row["password"];
    //}

    $oldHashedPassword = hashedPassword512($username, $oldPW);

    if ($passwordDB != $oldHashedPassword) {
        array_push($errorMessages, "Old passwords are not the same!");
    }

    if ($oldPW == $newPW || $oldPW == $newPwAgain) {
        array_push($errorMessages, "Old and new passwords can't be the same!");
    }

    if ($newPW != $newPwAgain) {
        array_push($errorMessages, "The two new passwords are not the same!");
    }

    if (strlen($newPW) < 6) {
        array_push($errorMessages, "New password needs to be at least 6 characters!");
    }

    if (count($errorMessages) == 0) {
        $hashedPassword = hashedPassword512($username, $newPW);

        try {
            $query = $pdo->prepare("UPDATE users SET password = :password WHERE username ='" . $username . "'");
            $query->bindValue(':password', $hashedPassword);
            $query->execute();

            header("Location: account.php?success=You've successfully changed your password! On your next login, use your new password!");
            exit;
        } catch (Exception $e) {
            echo "Failed to change password: " . $e->getMessage();
        }
    }
}

$accountDetails = $pdo->query("SELECT * FROM users WHERE username ='" . $_COOKIE['login'] . "'");
?>

<?php

include $template;
?>