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
        $accountDetails = $pdo->query("SELECT * FROM users WHERE username ='" . $_COOKIE['login'] . "'");
        $accountDetails->execute();
        $row = $accountDetails->fetch();
    }

    if(isset($_POST["pay"])) {
        if(!isset($_POST["paymentmethod"])) {
            $errorMessage = "Selecteer een betaald methode!";
        } else {
            $products = $_COOKIE["winkelmand"];
            $date = date("d-m-Y H:i:s");
            $price = $_POST["price"];
            $paymentMethod = $_POST["paymentmethod"];
            $delivery_date = $_POST["fullDate"];
            if(userLoggedIn()) {
                $accountDetails = $pdo->query("SELECT id FROM users WHERE username ='" . $_COOKIE['login'] . "'");
                $accountDetails->execute();
                $row = $accountDetails->fetch();
                $userID = $row["id"];

                $query = $pdo->prepare("INSERT INTO get_order (customerID, products, date, price, paymentmethod, delivery_date) VALUES (:customerID, :products, :date, :price, :paymentmethod, :delivery_date)");
                $query->bindValue(':customerID', $userID);
                $query->bindValue(':products', $products);
                $query->bindValue(':date', $date);
                $query->bindValue(':price', $price);
                $query->bindValue(':paymentmethod', $paymentMethod);
                $query->bindValue(':delivery_date', $delivery_date);
                $query->execute();
            } else {
                $email = $_POST["email"];
                $voornaam = $_POST["voornaam"];
                $tussenvoegsels = $_POST["tussenvoegsels"];
                $achternaam = $_POST["achternaam"];
                $straat = $_POST["straat"];
                $huisnummer = $_POST["huisnummer"];
                $woonplaats = $_POST["woonplaats"];
                $postcode = $_POST["postcode"];
                $telefoonnummer = $_POST["telefoonnummer"];

                $query = $pdo->prepare("INSERT INTO guest_order (email, voornaam, tussenvoegsels, achternaam, straat, huisnummer, woonplaats, postcode, telefoonnummer) VALUES (:email, :voornaam, :tussenvoegsels, :achternaam, :straat, :huisnummer, :woonplaats, :postcode, :telefoonnummer)");
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
                $guestID = $pdo->lastInsertId();

                $query = $pdo->prepare("INSERT INTO get_order (guestID, products, date, price, paymentmethod, delivery_date) VALUES (:guestID, :products, :date, :price, :paymentmethod, :delivery_date)");
                $query->bindValue(':guestID', $guestID);
                $query->bindValue(':products', $products);
                $query->bindValue(':date', $date);
                $query->bindValue(':price', $price);
                $query->bindValue(':paymentmethod', $paymentMethod);
                $query->bindValue(':delivery_date', $delivery_date);
                $query->execute();
            }
            unset($_COOKIE['winkelmand']);
            setcookie("winkelmand", "", time()-3600);
            header("Location: pay.php?success=Je hebt succesvol betaald! Je bestelling word klaar gemaakt!");
            exit;
        }
    }
?>

<?php
    include $template;
?>