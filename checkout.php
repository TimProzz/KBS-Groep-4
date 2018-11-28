<?php
    include_once "package.inc.php";
    $views = "views/checkout.php";
?>

<?php

    if(!userLoggedIn()) {
        header("Location: index.php?error=You need to be logged in to get access to this page!");
        exit;
    }

?>

<?php
    include $template;
?>