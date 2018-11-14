<?php
    function getCartTotal($productid) {
        if(isset($_COOKIE["winkelmand"])) {
            $theCart = json_decode($_COOKIE["winkelmand"]);
            foreach($theCart->listW as $key => $value) {
                if($theCart->listW[$key]->productid == $productid) {
                    return $theCart->listW[$key]->hoeveel;   
                }
            }
        }
        return 0;
    }

    function countCartTotal() {
        $count = 0;
        if(isset($_COOKIE["winkelmand"])) {
            $theCart = json_decode($_COOKIE["winkelmand"]);
            foreach($theCart->listW as $key => $value) {
                $count += $theCart->listW[$key]->hoeveel;
            }
            return $count;
        }
        return 0;
    }

    function checkIfUsernameExists($username, $pdo) {
        $usernameIsSet = 0;
        $allUsernames = $pdo->query("SELECT username FROM users");
        $allUsernames->execute();
        while($singleUsername = $allUsernames->fetch()) {
            if($singleUsername["username"] == $username) {
                $usernameIsSet = 1;
            }
        }
        return $usernameIsSet;
    }

    function loginUser($username) {
        setcookie("login", $username, time() + (86400 * 30), "/"); //Set username as login for 30 days
    }

    function hashedPassword512($username, $password) {
        return hash("sha512", $username.$password);
    }
?>