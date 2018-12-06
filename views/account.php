<div class="container push-padding">
    <h2>Mijn account</h2>
    <?php
        $amountControls = 3;
        $amountControlsWidth = (100 / $amountControls) . "%";
    ?>
    <div class="accountControls">
        <div class="singleAccountControl nawGegevens singleAccountControlActive" style="width: <?php echo $amountControlsWidth; ?>;" data-change="nawGegevens">Mijn NAW gegevens</div>
        <div class="singleAccountControl mijnBestellingen" style="width: <?php echo $amountControlsWidth; ?>;" data-change="mijnBestellingen">Mijn bestellingen</div>
        <div class="singleAccountControl wachtwoordWijzigen" style="width: <?php echo $amountControlsWidth; ?>;" data-change="wachtwoordWijzigen">Wachtwoord wijzigen</div>
    </div>
    <hr>
    <?php
        if(count($errorMessages) >= 1) {
            foreach ($errorMessages as $value) {
                echo $value . "<br />";
            }
        }

        if(isset($changeSuccessful)) {
            echo $changeSuccessful . "<br />";
        }
    ?>
    <div class="singleAccountTab nawGegevens">
        <h3>NAW gegevens wijzigen</h3>
        <?php
        while ($row = $accountDetails->fetch()) {
            ?>
            <form action="account.php" method="post">
                    Email:<br><input type="text" name="email" placeholder="Email" value="<?php if (!empty($row['email'])) {
                echo $row['email'];
            } ?>"><?php if(isset($_SESSION["legeNAW"])) { foreach($_SESSION["legeNAW"] as $item) { if($item == "email") { echo "<span class='requiredField'>* Vul dit veld in!</span>"; } } } ?><br>
                    Voornaam:<br><input type="text" name="voornaam" placeholder="Voornaam" value="<?php if (!empty($row['voornaam'])) {
                echo $row['voornaam'];
            } ?>"><?php if(isset($_SESSION["legeNAW"])) { foreach($_SESSION["legeNAW"] as $item) { if($item == "voornaam") { echo "<span class='requiredField'>* Vul dit veld in!</span>"; } } } ?><br>
                    Tussenvoegsels:<br><input type="text" name="tussenvoegsels" placeholder="Tussenvoegsels" value="<?php if (!empty($row['tussenvoegsels'])) {
                echo $row['tussenvoegsels'];
            } ?>"><br>
                    Achternaam:<br><input type="text" name="achternaam" placeholder="Achternaam" value="<?php if (!empty($row['achternaam'])) {
                echo $row['achternaam'];
            } ?>"><?php if(isset($_SESSION["legeNAW"])) { foreach($_SESSION["legeNAW"] as $item) { if($item == "achternaam") { echo "<span class='requiredField'>* Vul dit veld in!</span>"; } } } ?><br><br><br>
                    Straat:<br><input type="text" name="straat" placeholder="Straat" value="<?php if (!empty($row['straat'])) {
                echo $row['straat'];
            } ?>"><?php if(isset($_SESSION["legeNAW"])) { foreach($_SESSION["legeNAW"] as $item) { if($item == "straat") { echo "<span class='requiredField'>* Vul dit veld in!</span>"; } } } ?><br>
                    Huisnummer:<br><input type="text" name="huisnummer" placeholder="Huisnummer" value="<?php if (!empty($row['huisnummer'])) {
                echo $row['huisnummer'];
            } ?>"><?php if(isset($_SESSION["legeNAW"])) { foreach($_SESSION["legeNAW"] as $item) { if($item == "huisnummer") { echo "<span class='requiredField'>* Vul dit veld in!</span>"; } } } ?><br>
                    Woonplaats:<br><input type="text" name="woonplaats" placeholder="Woonplaats" value="<?php if (!empty($row['woonplaats'])) {
                echo $row['woonplaats'];
            } ?>"><?php if(isset($_SESSION["legeNAW"])) { foreach($_SESSION["legeNAW"] as $item) { if($item == "woonplaats") { echo "<span class='requiredField'>* Vul dit veld in!</span>"; } } } ?><br>
                    Postcode:<br><input type="text" name="postcode" placeholder="Postcode" value="<?php if (!empty($row['postcode'])) {
                echo $row['postcode'];
            } ?>"><?php if(isset($_SESSION["legeNAW"])) { foreach($_SESSION["legeNAW"] as $item) { if($item == "postcode") { echo "<span class='requiredField'>* Vul dit veld in!</span>"; } } } ?><br>
                    Telefoonnummer:<br><input type="number" name="telefoonnummer" placeholder="Telefoonnummer" value="<?php if (!empty($row['telefoonnummer'])) {
                echo $row['telefoonnummer'];
            } ?>"><br><br>
                    <input type="submit" value="Wijzigen" name="changeNAW">
                </form>
            <?php
        }
        unset($_SESSION["legeNAW"]);
        ?>
    </div>
    
    <div class="singleAccountTab mijnBestellingen accountContainerHidden">
        <h3>Mijn bestellingen</h3>
        <div class="bestellingen">
            <?php
                $totaalPrijs = 0;
                $count = 0;
                while($orderResult = $userOrders->fetch()) {
                    $singleOrder = json_decode($orderResult["products"]);
                    $orderNumber = $orderResult["id"];
                    $orderDatum = $orderResult["date"];
                    ?>
                    <div class="order">
                        <div class="orderTop" data-id="orderMiddle<?php echo $orderNumber; ?>">
                            <span><?php echo $orderResult["date"]; ?><br><?php echo "Ordernummer: " . $orderNumber; ?></span>
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
                                <strong>Totaal: </strong><?php echo "&euro;" . number_format($priceTotalOfOrder, 2); ?><br>
                                <strong>Status: </strong><?php echo $orderResult["status"]; ?>
                            </div>
                        </div>
                    </div><br>
                    <?php
                }
            ?>
        </div>
    </div>
    
    <div class="singleAccountTab wachtwoordWijzigen accountContainerHidden">
        <h3>Wachtwoord wijzigen</h3>
        <form action="account.php" method="post">
            Oud wachtwoord:<br><input type="password" name="oldPassword" placeholder="Oud wachtwoord" required><br>
            Nieuw wachtwoord:<br><input type="password" name="newPassword" placeholder="Nieuw wachtwoord" required><br>
            Nieuw wachtwoord opnieuw:<br><input type="password" name="newPasswordAgain" placeholder="Nieuw wachtwoord opnieuw" required><br><br>
            <input type="submit" value="Wijzigen" name="changePW">
        </form>
    </div>
</div>