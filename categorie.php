<?php
    include_once "package.inc.php";
    $views = "views/categorie.php";
?>

<?php
    if(!isset($_GET["sort"])) {
        $stockItems = $pdo->query("SELECT * FROM StockItems S
            JOIN stockitemstockgroups SG ON S.StockItemID = SG.StockItemID
            JOIN stockgroups G ON SG.StockGroupID = G.StockGroupID
            JOIN stockitemholdings SH ON SH.StockItemID = S.StockItemID
            WHERE G.StockGroupID = " . $_GET['id']);
    } else {
        $sortValue = $_GET["sort"];
        
        switch($sortValue) {
            case "Naam":
                $stockItems = $pdo->query("SELECT * FROM StockItems S
                    JOIN stockitemstockgroups SG ON S.StockItemID = SG.StockItemID
                    JOIN stockgroups G ON SG.StockGroupID = G.StockGroupID
                    JOIN stockitemholdings SH ON SH.StockItemID = S.StockItemID
                    WHERE G.StockGroupID = " . $_GET['id'] . "
                    ORDER BY S.StockItemName");
                break;
            case "Prijs1":
                $stockItems = $pdo->query("SELECT * FROM StockItems S
                    JOIN stockitemstockgroups SG ON S.StockItemID = SG.StockItemID
                    JOIN stockgroups G ON SG.StockGroupID = G.StockGroupID
                    JOIN stockitemholdings SH ON SH.StockItemID = S.StockItemID
                    WHERE G.StockGroupID = " . $_GET['id'] . "
                    ORDER BY S.UnitPrice");
                break;
            case "Prijs2":
                $stockItems = $pdo->query("SELECT * FROM StockItems S
                    JOIN stockitemstockgroups SG ON S.StockItemID = SG.StockItemID
                    JOIN stockgroups G ON SG.StockGroupID = G.StockGroupID
                    JOIN stockitemholdings SH ON SH.StockItemID = S.StockItemID
                    WHERE G.StockGroupID = " . $_GET['id'] . "
                    ORDER BY S.UnitPrice DESC");
                break;
            case "Nieuwste":
                $stockItems = $pdo->query("SELECT * FROM StockItems S
                    JOIN stockitemstockgroups SG ON S.StockItemID = SG.StockItemID
                    JOIN stockgroups G ON SG.StockGroupID = G.StockGroupID
                    JOIN stockitemholdings SH ON SH.StockItemID = S.StockItemID
                    WHERE G.StockGroupID = " . $_GET['id'] . "
                    ORDER BY S.StockItemID");
                break;
            case "Oudste":
                $stockItems = $pdo->query("SELECT * FROM StockItems S
                    JOIN stockitemstockgroups SG ON S.StockItemID = SG.StockItemID
                    JOIN stockgroups G ON SG.StockGroupID = G.StockGroupID
                    JOIN stockitemholdings SH ON SH.StockItemID = S.StockItemID
                    WHERE G.StockGroupID = " . $_GET['id'] . "
                    ORDER BY S.StockItemID DESC");
                break;
            default:
                $stockItems = $pdo->query("SELECT * FROM StockItems JOIN stockitemholdings SH ON SH.StockItemID = S.StockItemID
                    WHERE G.StockGroupID = " . $_GET['id']);
        }
    }

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