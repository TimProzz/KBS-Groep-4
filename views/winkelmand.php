<div class="container product push-padding">
    <h1>
        Winkelmand
    </h1>
    <table class="table table-bordered tableCart">
        <thead>
            <tr>
                <th scope="col"><strong>Product naam:</strong></th>
                <th scope="col"><strong>Aantal:</strong></th>
                <th scope="col"><strong>Prijs per product (incl. BTW):</strong></th>
                <th scope="col"><strong>Totaal prijs:</strong></th>
            </tr>
        </thead>
        <?php
            $totaalPrijs = 0;
            if (isset($_COOKIE["winkelmand"])) {
                $theCart = json_decode($_COOKIE["winkelmand"]);
                //print_r($theCart);
                ?>
                <tbody>
                    <?php
                    $count = 0;
                    foreach ($theCart->listW as $key => $value) {
                        //echo $theCart->listW[$key]->active;

                        if ($theCart->listW[$key]->active == 1) {
                            $singleCartItem = $pdo->query("SELECT * FROM StockItems S JOIN stockitemstockgroups SG ON S.StockItemID = SG.StockItemID JOIN stockgroups G ON SG.StockGroupID = G.StockGroupID WHERE S.StockItemID = " . $theCart->listW[$key]->productid . " GROUP BY S.StockItemID");
                            while ($theCartItem = $singleCartItem->fetch()) {
                                echo "<tr class='fullProductRow' data-id='". $theCartItem["StockItemID"] ."'><td> <a href='product.php?id=" . $theCartItem["StockItemID"] . "'>" . $theCartItem["StockItemName"] . "</a></td>";
                                echo "<td> " ?><input type="number" name="hoeveel" min="0" placeholder="<?php echo getCartTotal($theCartItem["StockItemID"]); ?>" value="<?php echo getCartTotal($theCartItem["StockItemID"]); ?>" class="numberWinkelmand numberWinkelmand<?php echo $theCartItem["StockItemID"]; ?>"><input type="submit" name="submitWinkelmand" class="submitWinkelmand" data-id="<?php echo $theCartItem["StockItemID"]; ?>"><?php "<br />";
                                //echo "<td> " . $theCart->listW[$key]->hoeveel . "<br />";
                                echo "<td> &euro;" . number_format($theCartItem["RecommendedRetailPrice"], 2) . "</td>";
                                $price = $theCartItem["RecommendedRetailPrice"] * $theCart->listW[$key]->hoeveel;
                                echo "<td> &euro;" . "<span class='dynamicPriceProduct' data-id='". $theCartItem["StockItemID"] ."'>" . number_format($price, 2) . "</span></td></tr>";

                                $totaalPrijs += $price;
                            }
                        }
                        $count++;
                    }
                ?>
                </tbody>
                <?php
            }
            if($count == 0) {
                echo "<span>Er zijn nog geen producten aan uw winkelmand toegevoegd!</span>";
            }
            echo "<tfoot>
                <tr>
                <td><strong>Totaal:</strong></td>
                <td colspan='2'><strong class='winkelmandCount'>" . countCartTotal() . "</strong></td>";
            echo "<td colspan='1'><strong>&euro;</strong>" . "<strong class='dynamicPriceProductTotal'>" . number_format($totaalPrijs, 2) . "</strong></td>
                </tr>
              </tfoot>";
        ?>
    </table>
</div>