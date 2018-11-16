<?php
    include_once "package.inc.php";
    $views = "views/categorie.php";
?>

<?php
    $stockItems = $pdo->query("SELECT * FROM StockItems S
            JOIN stockitemstockgroups SG ON S.StockItemID = SG.StockItemID
            JOIN stockgroups G ON SG.StockGroupID = G.StockGroupID
            WHERE G.StockGroupID = " . $_GET['id']);

    // uitvoeren


    $postNumber = 0;
    $postRowDiv = 1;

    $stmt = $pdo->prepare("SELECT * FROM StockGroups WHERE StockGroupID = " . $_GET['id']);

    // uitvoeren
    $stmt->execute();
    $row = $stmt->fetch();     
?>

<?php
    include $template;
?>