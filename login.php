<?php
    include_once "package.inc.php";
    $views = "views/login.php";
?>

<?php
    if(isset($_COOKIE["login"])) {
        header("Location: /?error=You're already logged in!");
        exit;
    }

    $errorMessages = array();

    if(isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $hashedPassword = hashedPassword512($username, $password);
        
        $query = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username AND password = :password");
        $query->bindValue(":username", $username, PDO::PARAM_STR);
        $query->bindValue(":password", $hashedPassword, PDO::PARAM_STR);
        $query->execute();
        
        $count = $query->fetchColumn();
        if($count > 0) {
            loginUser($username);
            header("Location: /?success=You've successfully logged in!");
            exit;
        } else {
            array_push($errorMessages, "Invalid login details. Please try again!");
        }
    }
?>

<?php
    include $template;
?>