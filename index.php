<?php
    include_once "package.inc.php";
    $views = "views/index.php";
?>

<?php
    if(!isset($_GET["sort"])) {
        $stockItems = $pdo->query("SELECT * FROM StockItems");
    } else {
        $sortValue = $_GET["sort"];
        
        switch($sortValue) {
            case "Naam":
                $stockItems = $pdo->query("SELECT * FROM StockItems 
                    ORDER BY StockItemName");
                break;
            case "Prijs1":
                $stockItems = $pdo->query("SELECT * FROM StockItems 
                    ORDER BY UnitPrice");
                break;
            case "Prijs2":
                $stockItems = $pdo->query("SELECT * FROM StockItems 
                    ORDER BY UnitPrice DESC");
                break;
            case "Nieuwste":
                $stockItems = $pdo->query("SELECT * FROM StockItems 
                    ORDER BY StockItemID");
                break;
            case "Oudste":
                $stockItems = $pdo->query("SELECT * FROM StockItems 
                    ORDER BY StockItemID DESC");
                break;
            default:
                $stockItems = $pdo->query("SELECT * FROM StockItems");
        }
    }
?>


<?php
    include $template;
?>