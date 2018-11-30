<div class="container product push-padding">
    <form method="post" action="checkout.php">
        <input type="submit" value="Betalen" class="btn btn-outline-success full-button" />

        <h1>Afrekenen</h1><hr>
        <?php
            if(isset($errorMessage)) {
                echo $errorMessage;
            }
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
                            <span><input type="radio" name="paymentmethod" value="ideal"> iDeal</span><br>
                            <span><input type="radio" name="paymentmethod" value="overschrijven"> Overschrijven</span><br>
                            <span><input type="radio" name="paymentmethod" value="paypal"> Paypal</span><br>
                        </div>
                        <div class="single-overzicht">
                            <h3>Bezorging</h3>
                            <h4>Bezorgdatum</h4>
                            <?php
                                $datetime = new DateTime('+1 day');
                                ?><span><?php $date = $datetime->format('d-m-Y'); $fullDate = getDutchDayFromDate($date) . " " . $date; echo $fullDate; ?></span><?php
                                ?><input type='hidden' name='fullDate' value='<?php echo $fullDate;?>'/><?php
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                    <div class="overzicht-bestellen">
                        <h2>Bestelling versturen naar:</h2><br>
                        <div class="overzicht-bestellen flex-fix">
                            <div class="single-overzicht">
                                <h3>Gegevens</h3>
                                <h4>Factuur- en afleveradres</h4>

                                    <div class="form-group">Email: *<input class="form-control" type="text" name="email" placeholder="Email" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" required></div>
                                    <div class="form-group">Voornaam: *<input class="form-control" type="text" name="voornaam" placeholder="Voornaam" value="<?php if(isset($_POST['voornaam'])) { echo $_POST['voornaam']; } ?>" required></div>
                                    <div class="form-group">Tussenvoegsels:<input class="form-control" type="text" name="tussenvoegsels" placeholder="Tussenvoegsels" value="<?php if(isset($_POST['tussenvoegsels'])) { echo $_POST['tussenvoegsels']; } ?>" required></div>
                                    <div class="form-group">Achternaam: *<input class="form-control" type="text" name="achternaam" placeholder="Achternaam" value="<?php if(isset($_POST['achternaam'])) { echo $_POST['achternaam']; } ?>" required></div>
                                    <div class="form-row">
                                        <div class="form-group col-md-7">Straat: *<input class="form-control" type="text" name="straat" placeholder="Straat" value="<?php if(isset($_POST['straat'])) { echo $_POST['straat']; } ?>" required></div>
                                        <div class="form-group col-md-5">Huisnummer: *<input class="form-control" type="text" name="huisnummer" placeholder="Huisnummer" value="<?php if(isset($_POST['huisnummer'])) { echo $_POST['huisnummer']; } ?>" required></div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-7">Woonplaats: *<input class="form-control" type="text" name="woonplaats" placeholder="Woonplaats" value="<?php if(isset($_POST['woonplaats'])) { echo $_POST['woonplaats']; } ?>" required></div>
                                        <div class="form-group col-md-5">Postcode: *<input class="form-control" type="text" name="postcode" placeholder="Postcode" value="<?php if(isset($_POST['postcode'])) { echo $_POST['postcode']; } ?>" required></div>
                                    </div>
                                    <div class="form-group">Telefoonnummer: <input class="form-control" type="number" name="telefoonnummer" placeholder="Telefoonnummer" value="<?php if(isset($_POST['telefoonnummer'])) { echo $_POST['telefoonnummer']; } ?>" required></div><br>

                            </div>
                            <div class="single-overzicht">
                                <h3>Betaalwijze</h3>
                                <h4>Betaalmethode</h4>
                                <span><input type="radio" name="paymentmethod" value="ideal"> iDeal</span><br>
                                <span><input type="radio" name="paymentmethod" value="overschrijven"> Overschrijven</span><br>
                                <span><input type="radio" name="paymentmethod" value="paypal"> Paypal</span><br>
                            </div>
                            <div class="single-overzicht">
                                <h3>Bezorging</h3>
                                <h4>Bezorgdatum</h4>
                                <?php
                                    $datetime = new DateTime('+1 day');
                                    ?><span><?php $date = $datetime->format('d-m-Y'); $fullDate = getDutchDayFromDate($date) . " " . $date; echo $fullDate; ?></span><?php
                                    ?><input type='hidden' name='fullDate' value='<?php echo $fullDate;?>'/><?php
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
                $count = 0;
                if (isset($_COOKIE["winkelmand"])) {
                    $theCart = json_decode($_COOKIE["winkelmand"]);
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
            <input type='hidden' name='price' value='<?php echo number_format($totaalPrijs, 2);?>'/>
        </table>
        <a href="winkelmand.php">Winkelmand aanpassen</a>
        <input type="submit" name="pay" value="Betalen" class="btn btn-outline-success full-button" />
    </form>
</div>