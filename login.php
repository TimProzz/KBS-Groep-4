<?php
    include_once "package.inc.php";
    $views = "views/login.php";
?>

<?php

if (userLoggedIn()) {
    header("Location: index.php?error=Je bent al ingelogd!");
    exit;
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hashedPassword = hashedPassword512($username, $password);

    $query = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username AND password = :password");
    $query->bindValue(":username", $username, PDO::PARAM_STR);
    $query->bindValue(":password", $hashedPassword, PDO::PARAM_STR);
    $query->execute();

    $count = $query->fetchColumn();
    if ($count > 0) {
        loginUser($username);
        header("Location: index.php?success=Je hebt succesvol ingelogd!");
        exit;
    } else {
        header("Location: login.php?error=Ongeldige login gegevens. Probeer het opnieuw!");
        exit;
    }
}
?>

<?php
    include $template;
?>