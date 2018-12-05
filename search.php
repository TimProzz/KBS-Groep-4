<?php

include_once "package.inc.php";
$views = "views/index.php";
?>

<?php

if(isset($_GET["search"])) {
    $search = str_replace(" ", "%", $_GET["search"]);

    $stockItems = $pdo->query("SELECT * FROM StockItems
            WHERE StockItemName LIKE '%" . $search . "%'");
}

        if(isset($_GET["search"]) && $_GET["sort"]) {
            $sortValue = $_GET["sort"];
            $search = $_GET["search"];
        
            switch($sortValue) {
                case "Naam":
                    $stockItems = $pdo->query("SELECT * FROM StockItems WHERE StockItemName LIKE '%" . $search . "%' 
                        ORDER BY StockItemName");
                    break;
                case "Prijs1":
                    $stockItems = $pdo->query("SELECT * FROM StockItems WHERE StockItemName LIKE '%" . $search . "%'
                        ORDER BY UnitPrice");
                    break;
                case "Prijs2":
                    $stockItems = $pdo->query("SELECT * FROM StockItems WHERE StockItemName LIKE '%" . $search . "%'
                        ORDER BY UnitPrice DESC");
                    break;
                case "Nieuwste":
                    $stockItems = $pdo->query("SELECT * FROM StockItems WHERE StockItemName LIKE '%" . $search . "%'
                        ORDER BY StockItemID");
                    break;
                case "Oudste":
                    $stockItems = $pdo->query("SELECT * FROM StockItems WHERE StockItemName LIKE '%" . $search . "%'
                        ORDER BY StockItemID DESC");
                    break;
                default:
                    $stockItems = $pdo->query("SELECT * FROM StockItems WHERE StockItemName LIKE '%" . $search . "%'");
            }
        }

?>


<?php

include $template;
?>