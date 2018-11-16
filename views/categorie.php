<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php echo $row["StockGroupName"]; ?>
            </li>
        </ol>
    </nav>
    <table class="table table-bordered tableHistory tableHistory1">
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
            <table class="table table-bordered tableHistory tableHistory<?php echo $postRowDiv; ?>">
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
                <th><strong><?php echo $singleStockItem["StockItemID"]; ?></strong></th>
                <th><a href="product.php?id=<?php echo $singleStockItem["StockItemID"]; ?>"><?php echo $singleStockItem["StockItemName"]; ?></a></th>
                <th><input type="number" name="hoeveel" min="0" placeholder="<?php echo getCartTotal($singleStockItem["StockItemID"]); ?>" value="<?php echo getCartTotal($singleStockItem["StockItemID"]); ?>" class="numberWinkelmand numberWinkelmand<?php echo $singleStockItem["StockItemID"]; ?>"></th>
                <th><input type="submit" name="submitWinkelmand" class="submitWinkelmand" data-id="<?php echo $singleStockItem["StockItemID"]; ?>"></th>
            </tr>
            <?php
        }
        ?>
    </table>
    <div class="pageSelect">
        <?php
        echo "Pagina: ";
        for ($i = 1; $i <= $postRowDiv; $i++) {
            ?><a class="linkReactPage reactionPageNumber<?php echo $i; ?>" id="tableHistory<?php echo $i; ?>"><?php echo $i; ?></a><?php
        }
        ?>
    </div>
    <br>

</div>