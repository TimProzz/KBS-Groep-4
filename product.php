<?php
    include_once "package.inc.php";
    $views = "views/product.php";
?>

<?php
    $stmt = $pdo->prepare("SELECT * FROM StockItems S
                    JOIN stockitemstockgroups SG ON S.StockItemID = SG.StockItemID
                    JOIN stockgroups G ON SG.StockGroupID = G.StockGroupID
                    WHERE S.StockItemID = " . $_GET['id']);

    // uitvoeren
    $stmt->execute();
    $row = $stmt->fetch();
?>

<?php
    include $template;
?>