<?php
    include_once "package.inc.php";
    $views = "views/adminPanel.php";
?>

<?php

    if(getUserLevel($pdo) != "Medewerker" && getUserLevel($pdo) != "Admin") {
        header("Location: index.php?error=Je hebt geen toegang tot deze pagina!");
        exit;
    }

    $userOrders = $pdo->query("SELECT * FROM get_order ORDER BY id DESC");
    $allUsers = $pdo->query("SELECT * FROM users");

    if(isset($_POST["submitChange"])) {
        $valueToChange = intval($_POST["valueOption"]);
        $userID = $_GET["id"];
        $queryChangeRights = ("UPDATE users SET rechten='" . $valueToChange . "' WHERE id= '". $userID. "'");
        $queryChangeRightsResult = $pdo->prepare( $queryChangeRights );
        $queryChangeRightsResult->execute();
        header("Location: adminPanel.php?success=Successvol rechten aangepast van gebruiker!");
        exit;
    }

    if(isset($_POST["submitChangeStatus"])) {
        $valueToChange = $_POST["valueOptionStatus"];
        $userID = $_GET["id"];
        $queryChangeRights = ("UPDATE get_order SET status='" . $valueToChange . "' WHERE id= '". $userID. "'");
        $queryChangeRightsResult = $pdo->prepare( $queryChangeRights );
        $queryChangeRightsResult->execute();
        header("Location: adminPanel.php?success=Successvol status aangepast van bestelling!");
        exit;
    }

?>

<?php
    include $template;
?>