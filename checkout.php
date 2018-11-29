<?php
    include_once "package.inc.php";
    $views = "views/checkout.php";
?>

<?php

    if(userLoggedIn()) {
        $userDetails = $pdo->query("SELECT * FROM users WHERE username ='" . $_COOKIE['login'] . "'");
    
        $legeNAW = array();

        while($row = $userDetails->fetch()) {
            if(empty($row["email"])) {
                array_push($legeNAW, "email");
            }
            if(empty($row["voornaam"])) {
                array_push($legeNAW, "voornaam");
            }
            if(empty($row["achternaam"])) {
                array_push($legeNAW, "achternaam");
            }
            if(empty($row["straat"])) {
                array_push($legeNAW, "straat");
            }
            if(empty($row["huisnummer"])) {
                array_push($legeNAW, "huisnummer");
            }
            if(empty($row["woonplaats"])) {
                array_push($legeNAW, "woonplaats");
            }
            if(empty($row["postcode"])) {
                array_push($legeNAW, "postcode");
            }
        }

        if(count($legeNAW) >= 1) {
            $_SESSION["legeNAW"] = $legeNAW;
            header("Location: account.php?error=Je moet eerst je NAW-gegevens invullen voordat je kan afrekenen!");
            exit;
        }
    }
?>

<?php
    include $template;
?>