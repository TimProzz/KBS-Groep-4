<?php
    if(isset($_POST["newProductID"]) && !empty($_POST["newProductID"])) {
        include("connection.php");
        $getPriceByID = json_decode($_POST["newProductID"]);
        $newPriceOfProduct = $pdo->query("SELECT RecommendedRetailPrice FROM stockitems WHERE StockItemID =  '" . $getPriceByID . "'");
        while ($singleNewPriceOfProduct = $newPriceOfProduct->fetch()) {
            echo json_encode($singleNewPriceOfProduct["RecommendedRetailPrice"]);
        }
        exit;
    }
?>

<?php
    include_once "package.inc.php";
    $views = "views/winkelmand.php";
?>

<?php
    include $template;
?>