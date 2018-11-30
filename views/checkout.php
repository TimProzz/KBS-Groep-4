<div class="container product push-padding">
    <form action="pay.php" class="formGoToCheckout">
        <input type="submit" value="Betalen" class="btn btn-outline-success full-button" />
    </form>
    <h1>Afrekenen</h1><hr>
    
    <?php
        if(userLoggedIn()) {
            ?>
            <div class="overzicht-bestellen">
                <h2>Bestelling versturen naar:</h2><br>
                <div class="overzicht-bestellen flex-fix">
                    <div class="single-overzicht">
                        <h3>Gegevens</h3>
                        <h4>Factuur- en afleveradres</h4>
                        <span><?php echo $row["voornaam"]; if(!empty($row["tussenvoegsels"])) { echo " " . $row["tussenvoegsels"]; } echo " " . $row["achternaam"]; ?></span><br>
                        <span><?php echo $row["straat"] . " " . $row["huisnummer"]; ?></span><br>
                        <span><?php echo $row["postcode"] . ", " . $row["woonplaats"]; ?></span><br><br>
                        <h4>Contactgegevens</h4>
                        <span><?php echo $row["email"];?></span><br>
                        <?php if(!empty($row["telefoonnummer"])) { ?><span><?php echo $row["telefoonnummer"]; ?></span><br><?php } ?>
                        <a href="account.php">Gegevens wijzigen</a>
                    </div>
                    <div class="single-overzicht">
                        <h3>Betaalwijze</h3>
                        <h4>Betaalmethode</h4>
                        <span>iDeal</span>
                    </div>
                    <div class="single-overzicht">
                        <h3>Bezorging</h3>
                        <h4>Bezorgdatum</h4>
                        <?php
                            $datetime = new DateTime('+1 day');
                            ?><span><?php $date = $datetime->format('d-m-Y'); echo getDutchDayFromDate($date) . " " . $date; ?></span><?php
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
    ?>
    
    <hr>
    <h2>Mijn bestelling</h2>
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
                <td colspan='2'><strong class='winkelmandCount'>&euro;" . number_format($totaalPrijs, 2) . "</strong></td>
            
                </tr>
              </tfoot>";
        ?>
    </table>
    <a href="winkelmand.php">Winkelmand aanpassen</a>
    <form action="pay.php" class="formGoToCheckout">
        <input type="submit" value="Betalen" class="btn btn-outline-success full-button" />
    </form>
</div>