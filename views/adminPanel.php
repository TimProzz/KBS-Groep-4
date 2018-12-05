<div class="container product push-padding">
    <h2>Admin panel</h2>
    <?php
        $amountControls = 2;
        $amountControlsWidth = (100 / $amountControls) . "%";
    ?>
    <div class="accountControls">
        <div class="singleAccountControl alleBestellingen singleAccountControlActive" style="width: <?php echo $amountControlsWidth; ?>;" data-change="alleBestellingen">Alle bestellingen</div>
        <div class="singleAccountControl accountRechten" style="width: <?php echo $amountControlsWidth; ?>;" data-change="accountRechten">Account rechten</div>
    </div>
    <hr>
    <div class="singleAccountTab alleBestellingen">
        <h3>Alle bestellingen</h3>
        <div class="bestellingen">
            <?php
                $totaalPrijs = 0;
                $count = 0;
                while($orderResult = $userOrders->fetch()) {
                    $singleOrder = json_decode($orderResult["products"]);
                    
                    $userID = $orderResult["customerID"];
                    $guestID = $orderResult["guestID"];
                    
                    $theIdOfOrder = getUserDetailsById($userID, $guestID);
                    if($theIdOfOrder[0] == "Customer") {
                        $accountDetails = $pdo->prepare("SELECT * FROM users WHERE id = '" . $theIdOfOrder[1] . "'");
                    } else {
                        $accountDetails = $pdo->prepare("SELECT * FROM guest_order WHERE id = '" . $theIdOfOrder[1] . "'");
                    }
                    $accountDetails->execute();
                    $row = $accountDetails->fetch();
                    
                    $orderNumber = $orderResult["id"];
                    $orderDatum = $orderResult["date"];
                    ?>
                    <div class="order">
                        <div class="orderTop" data-id="orderMiddle<?php echo $orderNumber; ?>">
                            <span><?php echo $orderResult["date"]; ?><br><?php echo "Ordernummer: " . $orderNumber; ?><br><?php echo $row["voornaam"] . " " . $row["achternaam"] . "<br>" . $row["straat"] . " " . $row["huisnummer"] . "<br>" . $row["postcode"] . ", " . $row["woonplaats"]; ?></span>
                            <span class="orderArrowDown" id="orderMiddle<?php echo $orderNumber; ?>Arrow"><i class="fa fa-angle-double-down" aria-hidden="true"></i></span>
                        </div>
                        <div class="orderContent" id="orderMiddle<?php echo $orderNumber; ?>">
                            <div class="orderMiddle">
                                <div class="floatContainer" style="width: 50%;">
                                    <h5>Naam product:</h5>
                                    <?php
                                    $priceTotalOfOrder = 0;
                                    foreach($singleOrder->listW as $key => $value) {
                                        if ($singleOrder->listW[$key]->active == 1) {
                                            $singleOrderedProduct = $pdo->query("SELECT * FROM StockItems S JOIN stockitemstockgroups SG ON S.StockItemID = SG.StockItemID JOIN stockgroups G ON SG.StockGroupID = G.StockGroupID WHERE S.StockItemID = " . $singleOrder->listW[$key]->productid . " GROUP BY S.StockItemID");
                                            while($theOrderedProduct = $singleOrderedProduct->fetch()) {
                                                echo $singleOrder->listW[$key]->hoeveel; ?> x <a href="product.php?id=<?php echo $theOrderedProduct["StockItemID"]; ?>"><?php echo $theOrderedProduct["StockItemName"]; ?></a><br><?php
                                            }
                                        }
                                        $count++;
                                    }
                                    ?>
                                </div>
                                <div class="floatContainer" style="width: 25%;">
                                    <h5>Prijs per product:</h5>
                                    <?php
                                    foreach($singleOrder->listW as $key => $value) {
                                        if ($singleOrder->listW[$key]->active == 1) {
                                            $singleOrderedProduct = $pdo->query("SELECT * FROM StockItems S JOIN stockitemstockgroups SG ON S.StockItemID = SG.StockItemID JOIN stockgroups G ON SG.StockGroupID = G.StockGroupID WHERE S.StockItemID = " . $singleOrder->listW[$key]->productid . " GROUP BY S.StockItemID");
                                            while($theOrderedProduct = $singleOrderedProduct->fetch()) {
                                                echo "&euro;" . $theOrderedProduct["RecommendedRetailPrice"]. "<br>";
                                            }
                                        }
                                        $count++;
                                    }
                                    ?>
                                </div>
                                <div class="floatContainer" style="width: 25%;">
                                    <h5>Totaal:</h5>
                                    <?php
                                    foreach($singleOrder->listW as $key => $value) {
                                        if ($singleOrder->listW[$key]->active == 1) {
                                            $singleOrderedProduct = $pdo->query("SELECT * FROM StockItems S JOIN stockitemstockgroups SG ON S.StockItemID = SG.StockItemID JOIN stockgroups G ON SG.StockGroupID = G.StockGroupID WHERE S.StockItemID = " . $singleOrder->listW[$key]->productid . " GROUP BY S.StockItemID");
                                            while($theOrderedProduct = $singleOrderedProduct->fetch()) {
                                                $priceProductsTotal = $singleOrder->listW[$key]->hoeveel * $theOrderedProduct["RecommendedRetailPrice"];
                                                echo "&euro;" . number_format($priceProductsTotal, 2) . "<br>";
                                                $priceTotalOfOrder += $priceProductsTotal;
                                            }
                                        }
                                        $count++;
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="orderBottom">
                                <strong>Totaal: </strong><?php echo "&euro;" . number_format($priceTotalOfOrder, 2); ?>
                            </div>
                        </div>
                    </div><br>
                    <?php
                }
            ?>
        </div>
    </div>
    <div class="singleAccountTab accountRechten">
        <h2>Account rechten</h2>
        <?php
            while($row = $allUsers->fetch()) {
                ?>
                <div>
                    Gebruiker: <strong><?php echo $row["username"]; ?></strong> - <?php echo getUserLevelById($pdo, $row["id"]); ?><br>
                    <form method="post" action="adminPanel.php?id=<?php echo $row["id"]; ?>">
                        <select name="valueOption">
                            <option value="4">Gebruiker</option>
                            <option value="3">Leverancier</option>
                            <option value="2">Medewerker</option>
                            <option value="1">Admin</option>
                        </select><br>
                        <input type="submit" name="submitChange" value="Veranderen" style="float: left;" class="btn btn-outline-success full-button" />
                    </form>
                    <br>
                </div><br>
                <?php
            }
        ?>
    </div>
</div>