<?php
    include("package.inc.php");
?>

<?php
    unset($_COOKIE['login']);
    setcookie("login", "", time() - 3600, "/");

    header("Location: /?Success=Successfully logged out!");
    exit;
?>