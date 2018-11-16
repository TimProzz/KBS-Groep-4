<?php
    function getCartTotal($productid) { // Gets the total price of all products in cart.
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

    function countCartTotal() { // Gets the total items in the cart
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

    function checkIfUsernameExists($username, $pdo) { // Checks if the given username exists in the database table 'users'
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

    function loginUser($username) { // Logs the user in with given username
        setcookie("login", $username, time() + (86400 * 30), "/"); //Set username as login for 30 days
    }

    function hashedPassword512($username, $password) { // Hashes the password with username and password
        return hash("sha512", $username.$password);
    }
?>