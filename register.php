<?php

include_once "package.inc.php";
$views = "views/register.php";
?>

<?php

if (isset($_COOKIE["login"])) {
    header("Location: index.php?error=You're already logged in!");
    exit;
}

$errorMessages = array();

if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordCheck = $_POST["passwordCheck"];

    if ($password != $passwordCheck) {
        array_push($errorMessages, "Passwords are not the same!");
    }

    if (strlen($password) < 6) {
        array_push($errorMessages, "Password needs to be at least 6 characters!");
    }

    if (strlen($username) < 6) {
        array_push($errorMessages, "Username needs to be at least 6 characters!");
    }

    $usernameIsSet = checkIfUsernameExists($username, $pdo);

    if ($usernameIsSet == 1) {
        array_push($errorMessages, "The username is already existing!");
    }

    if (count($errorMessages) == 0) {
        $hashedPassword = hashedPassword512($username, $password);

        try {
            $query = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $query->bindValue(':username', $username);
            $query->bindValue(':password', $hashedPassword);
            $query->execute();

            $registerSuccessful = "You've successfully registered yourself. You can now <a href='login.php'>login</a> using your details!";
        } catch (Exception $e) {
            echo "Failed to register new user: " . $e->getMessage();
        }
    }
}
?>

<?php

include $template;
?>