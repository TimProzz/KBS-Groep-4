<?php

include_once "package.inc.php";
$views = "views/register.php";
?>

<?php

if(userLoggedIn()) {
    header("Location: index.php?error=Je bent al ingelogd!");
    exit;
}

$errorMessages = array();

if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordCheck = $_POST["passwordCheck"];
    $email = $_POST["email"];
    $surname = $_POST["surname"];
    $infix = $_POST["infix"];
    $last_name = $_POST["last_name"];
    $street = $_POST["street"];
    $housenumber = $_POST["housenumber"];
    $city = $_POST["city"];
    $postal_code = $_POST["postal_code"];
    $phonenumber = $_POST["phonenumber"];

    if ($password != $passwordCheck) {
        array_push($errorMessages, "Wachtwoorden zijn niet hetzelfde!");
    }

    if (strlen($password) < 6) {
        array_push($errorMessages, "Wachtwoord moet minimaal 6 tekens bevatten!");
    }

    if (strlen($username) < 6) {
        array_push($errorMessages, "Gebruikersnaam moet minimaal 6 tekens bevatten!");
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errorMessages, "Emailadres is niet geldig!");
    }

    $usernameIsSet = checkIfUsernameExists($username, $pdo);
    $emailIsSet = checkIfUsernameExists($email, $pdo);

    if($usernameIsSet == 1) {
        array_push($errorMessages, "De gebruikersnaam bestaat al!");
    }
    
    if($emailIsSet == 1) {
        array_push($errorMessages, "De email bestaat al!");
    }

    if (count($errorMessages) == 0) {
        $hashedPassword = hashedPassword512($username, $password);
        $rechten = 4;

        try {
            $query = $pdo->prepare("INSERT INTO users (username, password, email, voornaam, tussenvoegsels, achternaam, straat, huisnummer, woonplaats, postcode, telefoonnummer, rechten) VALUES (:username, :password, :email, :voornaam, :tussenvoegsels, :achternaam, :straat, :huisnummer, :woonplaats, :postcode, :telefoonnummer, :rechten)");
            $query->bindValue(':username', $username);
            $query->bindValue(':password', $hashedPassword);
            $query->bindValue(':email', $email);
            $query->bindValue(':voornaam', $surname);
            $query->bindValue(':tussenvoegsels', $infix);
            $query->bindValue(':achternaam', $last_name);
            $query->bindValue(':straat', $street);
            $query->bindValue(':huisnummer', $housenumber);
            $query->bindValue(':woonplaats', $city);
            $query->bindValue(':postcode', $postal_code);
            $query->bindValue(':telefoonnummer', $phonenumber);
            $query->bindValue(':rechten', $rechten);
            $query->execute();

            header("Location: register.php?success=Je hebt jezelf succesvol geregistreerd! Je kunt nu <a href='login.php'>inloggen</a> met je gegevens!");
            exit;
        } catch (Exception $e) {
            echo "Failed to register new user: " . $e->getMessage();
        }
    }
}
?>

<?php

include $template;
?>
