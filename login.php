<?php
    include_once "package.inc.php";
    $views = "views/login.php";
?>

<?php

if (userLoggedIn()) {
    header("Location: index.php?error=You're already logged in!");
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
        header("Location: index.php?success=You've successfully logged in!");
        exit;
    } else {
        header("Location: login.php?error=Invalid login details. Please try again!");
        exit;
    }
}
?>

<?php
    include $template;
?>