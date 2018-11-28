<div class="container product push-padding">
    <h1>Afrekenen</h1>
    
    <table class="table table-bordered tableCart">
        <thead>
            <tr>
                <th scope="col"><strong>Product naam:</strong></th>
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
                                echo "<tr class='fullProductRow' data-id='". $theCartItem["StockItemID"] ."'><td>" . getCartTotal($theCartItem["StockItemID"]) . "x <a href='product.php?id=" . $theCartItem["StockItemID"] . "'>" . $theCartItem["StockItemName"] . "</a></td>";
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
                <td><strong>Totaal: ". countCartTotal() ."</strong></td>
                <td colspan='2'><strong class='winkelmandCount'>" . number_format($totaalPrijs, 2) . "</strong></td>
            
                </tr>
              </tfoot>";
        ?>
    </table>
    
</div>