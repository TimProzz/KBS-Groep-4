<?php
include("template.php");
?>


<?php
//Dit is het index bestand voor KBS-Groep-4.2
//echo "Djordy zorgt voor de foto's van badeenden :( slecht ideeeeeee";
?>

<?php
$stockItems = $pdo->query("SELECT * FROM StockItems S
        JOIN stockitemstockgroups SG ON S.StockItemID = SG.StockItemID
        JOIN stockgroups G ON SG.StockGroupID = G.StockGroupID
        GROUP BY S.StockItemID");
?>


<?php
$postNumber = 0;
$postRowDiv = 1;
?>
<div style="overflow-x: auto;">
    <table class="tableHistory tableHistory1">
        <tr>
            <th><b>Nummer:</b></th>
            <th><b>Naam:</b></th>
            <th><b>Aantal:</b></th>
            <th><b>Voeg toe aan winkelmand:</b></th>
        </tr>
        <?php
        $i = 1;
        $countRows = 0;
        while ($singleStockItem = $stockItems->fetch()) {
            $postNumber++;
            $countRows++;
            if ($postNumber > 20) {
                $postNumber = 1;
                $postRowDiv++;
                ?>
            </table>
            <table class="tableHistory tableHistory<?php echo $postRowDiv; ?>">
                <tr>
                    <th><b>Nummer:</b></th>
                    <th><b>Naam:</b></th>
                    <th><b>Aantal:</b></th>
                    <th><b>Voeg toe aan winkelmand:</b></th>
                </tr>
                <?php
            }
            $stockCount = $stockItems->rowCount();
            ?>
            <tr>
                <th><b><?php echo $countRows; ?></b><?php echo ". "; ?></th>
                <th><a href="product.php?id=<?php echo $singleStockItem["StockItemID"]; ?>"><?php echo $singleStockItem["StockItemName"]; ?></a></th>
                <th><input type="number" name="hoeveel" min="0" placeholder="<?php echo getCartTotal($singleStockItem["StockItemID"]); ?>" value="<?php echo getCartTotal($singleStockItem["StockItemID"]); ?>" class="numberWinkelmand numberWinkelmand<?php echo $singleStockItem["StockItemID"]; ?>"></th>
                <th><input type="submit" name="submitWinkelmand" class="submitWinkelmand" data-id="<?php echo $singleStockItem["StockItemID"]; ?>"></th>
            </tr>
            <?php
        }
        ?>
    </table>
</div><br>
<div class="pageSelect">
    <?php
    echo "Pagina: ";
    for ($i = 1; $i <= $postRowDiv; $i++) {
        ?><a class="linkReactPage reactionPageNumber<?php echo $i; ?>" id="tableHistory<?php echo $i; ?>"><?php echo $i; ?></a><?php
    }
    ?>
</div>
<br>

</body>
</html>
