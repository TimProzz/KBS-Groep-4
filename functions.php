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

    function checkIfEmailExists($email, $pdo) { // Checks if the given email exists in the database table 'users'
        $emailIsSet = 0;
        $allEmails = $pdo->query("SELECT email FROM users");
        $allEmails->execute();
        while($singleEmail = $allEmails->fetch()) {
            if($singleEmail["email"] == $email) {
                $emailIsSet = 1;
            }
        }
        return $emailIsSet;
    }

    function loginUser($username) { // Logs the user in with given username
        setcookie("login", $username, time() + (86400 * 30), "/"); //Set username as login for 30 days
    }

    function userLoggedIn() {
        if(isset($_COOKIE["login"])) {
            return true;
        }
    }

    function hashedPassword512($username, $password) { // Hashes the password with username and password
        return hash("sha512", $username.$password);
    }

    function getUserLevelById($pdo, $userID) { //Gets the userlevel of given user ID
        if(userLoggedIn()) {
            $getUserLevel = $pdo->prepare("SELECT rechten FROM users WHERE id = '" . $userID . "'");
            $getUserLevel->execute();
            $row = $getUserLevel->fetch();
            $userLevelInt = $row["rechten"];
            switch($userLevelInt) {
                case 1:
                    return "Admin";
                    break;
                case 2:
                    return "Medewerker";
                    break;
                case 3:
                    return "Leverancier";
                    break;
                case 4:
                    return "Gebruiker";
                    break;
            }
        }
    }

    function getUserLevel($pdo) { //Gets the userlevel of logged in user
        if(userLoggedIn()) {
            $getUserLevel = $pdo->prepare("SELECT rechten FROM users WHERE username = '" . $_COOKIE["login"] . "'");
            $getUserLevel->execute();
            $row = $getUserLevel->fetch();
            $userLevelInt = $row["rechten"];
            switch($userLevelInt) {
                case 1:
                    return "Admin";
                    break;
                case 2:
                    return "Medewerker";
                    break;
                case 3:
                    return "Leverancier";
                    break;
                case 4:
                    return "Gebruiker";
                    break;
            }
        }
    }

    function sortProducts() {
        ?>
            <div class="sortProducts">
                <select class="sort">
                    <option selected="true" disabled="disabled">Sorteren op:</option>
                    <option value="Naam">Naam</option>
                    <option value="Prijs1">Prijs (laag-hoog)</option>
                    <option value="Prijs2">Prijs (hoog-laag)</option>
                    <option value="Nieuwste">Nieuwste</option>
                    <option value="Oudste">Oudste</option>
                </select>
            </div>
        <?php
    }
    
    function getYoutubeEmbedUrl($url){
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';

        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }

        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
        return 'https://www.youtube.com/embed/' . $youtube_id ;
    }

    function getUserDetailsById($customerID, $guestID) {
        if($customerID == 0) {
            return array("Guest", $guestID);
        } else {
            return array("Customer", $customerID);
        }
    }

    function getDutchDayFromDate($date) {
        switch(date('D', strtotime($date))) {
            case "Mon":
                return "Maandag";
                break;
            case "Tue":
                return "Dinsdag";
                break;
            case "Wed":
                return "Woensdag";
                break;
            case "Thu":
                return "Donderdag";
                break;
            case "Fri":
                return "Vrijdag";
                break;
            case "Sat":
                return "Zaterdag";
                break;
            case "Sun":
                return "Zondag";
                break;
            default:
                return "UNDEFINED Datum?";
        }
    }

?>