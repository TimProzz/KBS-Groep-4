<?php
    include_once "package.inc.php";
    $views = "views/index.php";
?>

<?php
    $stockItems = $pdo->query("SELECT * FROM StockItems S
            JOIN stockitemstockgroups SG ON S.StockItemID = SG.StockItemID
            JOIN stockgroups G ON SG.StockGroupID = G.StockGroupID
            GROUP BY S.StockItemID");
?>


<?php
    include $template;
?>
