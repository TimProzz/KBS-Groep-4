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


$accountDetails = $pdo->query("SELECT * FROM users WHERE username ='" . $_COOKIE['login'] . "'");

if (isset($_POST["changeNAW"])) {
    $naam = $_POST["naam"];
    $adres = $_POST["adres"];
    $woonplaats = $_POST["woonplaats"];

    try {
        $query = $pdo->prepare("UPDATE users SET naam = :naam, adres = :adres, woonplaats = :woonplaats WHERE username = '" . $_COOKIE['login'] . "'");
        $query->bindValue(':naam', $naam);
        $query->bindValue(':adres', $adres);
        $query->bindValue(':woonplaats', $woonplaats);
        $query->execute();

        $changeSuccessful = "You've successfully changed your NAW details!";
    } catch (Exception $e) {
        echo "Failed to change user details: " . $e->getMessage();
    }
}

if (isset($_POST["changePW"])) {
    $oldPW = $_POST["oldPassword"];
    $newPW = $_POST["newPassword"];
    $newPwAgain = $_POST["newPasswordAgain"];
    $username = $_COOKIE["login"];

    while ($row = $accountDetails->fetch()) {
        $passwordDB = $row["password"];
    }

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

            $changeSuccessful = "You've successfully changed your password! On your next login, use your new password!";
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