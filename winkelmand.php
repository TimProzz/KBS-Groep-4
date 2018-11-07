<?php
include("template.php");
?>

<div class="container product">
    <h1>
        Winkelwagen
    </h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col"><strong>Product naam:</strong></th>
                <th scope="col"><strong>Aantal:</strong></th>
                <th scope="col"><strong>Prijs per product:</strong></th>
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
                foreach ($theCart->listW as $key => $value) {
                    //echo $theCart->listW[$key]->active;

                    if ($theCart->listW[$key]->active == 1) {
                        $singleCartItem = $pdo->query("SELECT * FROM StockItems S JOIN stockitemstockgroups SG ON S.StockItemID = SG.StockItemID JOIN stockgroups G ON SG.StockGroupID = G.StockGroupID WHERE S.StockItemID = " . $theCart->listW[$key]->productid . " GROUP BY S.StockItemID");
                        while ($theCartItem = $singleCartItem->fetch()) {
                            echo "<tr><td> <a href='product.php?id=" . $theCartItem["StockItemID"] . "'>" . $theCartItem["StockItemName"] . "</a></td>";
                            echo "<td> " . $theCart->listW[$key]->hoeveel . "<br />";
                            echo "<td> &euro;" . number_format($theCartItem["UnitPrice"], 2) . "</td>";
                            $price = $theCartItem["UnitPrice"] * $theCart->listW[$key]->hoeveel;
                            echo "<td> &euro;" . number_format($price, 2) . "</td></tr>";

                            $totaalPrijs += $price;
                        }
                    }
                }
            }
            echo "<tfoot>
                <tr>
                <td><strong>Totaal:</strong></td>
                <td colspan='2'><span class='winkelmandCount'>" . countCartTotal() . "</span></td>";
            echo "<td colspan='1'>" . number_format($totaalPrijs, 2) . "</td>
                </tr>
              </tfoot>";
            ?>
        </tbody>
    </table>
</div>
</body>
</html>