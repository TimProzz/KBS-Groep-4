<?php
    session_start();
    include 'connection.php';
    include 'functions.php';

    $template = "template.php";

    if(userLoggedIn()) {
        $userDetails = $pdo->query("SELECT * FROM users WHERE username =  '" . $_COOKIE['login'] . "'");
    }
?>