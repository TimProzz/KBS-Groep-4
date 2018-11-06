        <?php
            include("template.php");
        ?>
    
        <?php
            $totaalPrijs = 0;
            if(isset($_COOKIE["winkelmand"])) {
                $theCart = json_decode($_COOKIE["winkelmand"]);
                //print_r($theCart);
                ?><br><br><?php
                foreach($theCart->listW as $key => $value) {
                    //echo $theCart->listW[$key]->active;

                    if($theCart->listW[$key]->active == 1) {
                        $singleCartItem = $pdo->query("SELECT * FROM StockItems S JOIN stockitemstockgroups SG ON S.StockItemID = SG.StockItemID JOIN stockgroups G ON SG.StockGroupID = G.StockGroupID WHERE S.StockItemID = ".$theCart->listW[$key]->productid." GROUP BY S.StockItemID");
                        while($theCartItem = $singleCartItem->fetch()) {
                            echo "<strong>Product naam:</strong> <a href='product.php?id=" .$theCartItem["StockItemID"]. "'>" . $theCartItem["StockItemName"] . "</a><br />";
                            echo "<strong>Aantal:</strong> " . $theCart->listW[$key]->hoeveel . "<br />";
                            echo "<strong>Prijs per product:</strong> &euro;" . number_format($theCartItem["UnitPrice"], 2) . "<br />";
                            $price = $theCartItem["UnitPrice"] * $theCart->listW[$key]->hoeveel;
                            echo "<strong>Totaal prijs:</strong> &euro;" . number_format($price, 2) . "<br /><br />";

                            $totaalPrijs += $price;
                        }

                    }
                }
            }
            echo "<strong>Totaal bedrag:</strong> &euro;" . number_format($totaalPrijs, 2) . "<br />";
            echo "<strong>Totaal aantal producten:</strong> <span class='winkelmandCount'>" . countCartTotal() . "</span><br />";
        ?>

    </body>
</html>