        <?php
            include("template.php");
        ?>
    
        <?php
            $theCart = json_decode($_COOKIE["winkelmand"]);
            $totaalPrijs = 0;
            //print_r($theCart);
            ?><br><br><?php
            foreach($theCart->listW as $key => $value) {
                //echo $theCart->listW[$key]->active;
                
                if($theCart->listW[$key]->active == 1) {
                    $singleCartItem = $pdo->query("SELECT * FROM StockItems S JOIN stockitemstockgroups SG ON S.StockItemID = SG.StockItemID JOIN stockgroups G ON SG.StockGroupID = G.StockGroupID WHERE S.StockItemID = ".$theCart->listW[$key]->productid." GROUP BY S.StockItemID");
                    while($theCartItem = $singleCartItem->fetch()) {
                        echo $theCartItem["StockItemName"] . "<br />";
                        echo "Aantal: " . $theCart->listW[$key]->hoeveel . "<br />";
                        echo "Prijs per product: &euro;" . $theCartItem["UnitPrice"] . "<br />";
                        $price = $theCartItem["UnitPrice"] * $theCart->listW[$key]->hoeveel;
                        echo "Totaal prijs: &euro;" . $price . "<br /><br />";
                        
                        $totaalPrijs += $price;
                    }
                    
                }
            }
             echo "Totaal bedrag: &euro;" . $totaalPrijs;
        ?>

    </body>
</html>