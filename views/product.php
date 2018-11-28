<div class="container product push-padding">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" >
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">
                <a href="categorie.php?id=<?php echo $row["StockGroupID"]; ?>">
                    <?php echo $row["StockGroupName"]; ?>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php echo $row["StockItemName"]; ?>
            </li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-6">
            <img class="img-fluid" src="<?php if($row['imageName'] != '') { echo 'uploads/' . $row['imageName']; } else { echo 'https://via.placeholder.com/500'; } ?>">
        </div>
        <div class="col-lg-6 productInfo">
            <h5 class="card-title">
                <?php echo $row["StockItemName"]; ?>
            </h5>
            <h6 class="card-subtitle mb-2 text-muted">
                &euro;<?php echo $row["RecommendedRetailPrice"]; ?>
            </h6>
            <p class="card-text">
                <?php while ($cat = $stmt->fetch()) { ?>
                    <a href="categorie.php?id=<?php echo $cat["StockGroupID"]; ?>">
                        <?php echo $cat["StockGroupName"]; ?>
                    </a>
                    ,
                <?php } ?>
            </p>
            <p class="card-supply"><?php 
                if($row["QuantityOnHand"] >= 10) { 
                    echo "Voorraad: <span class='SupplyHigh'>10+</span>"; 
                } elseif ($row["QuantityOnHand"] < 10 && $row["QuantityOnHand"] > 0) {
                    echo "Voorraad: <span class= 'SupplyLow'>" . $row["QuantityOnHand"] . "</span>"; 
                  
                } elseif($row["QuantityOnHand"] <= 0) { 
                    echo "<span class= 'SupplyLow'> Product uitverkocht! </span>"; 
                  
                } ?></p>
            <input type="number" name="hoeveel" min="0" placeholder="<?php echo getCartTotal($row["StockItemID"]); ?>" value="<?php echo getCartTotal($row["StockItemID"]); ?>" class="numberWinkelmand numberWinkelmand<?php echo $row["StockItemID"]; ?>">
            <a href="#" class="btn btn-primary submitWinkelmand" data-id="<?php echo $row["StockItemID"]; ?>">In Winkelmand</a>
        </div>
    </div>
    <?php
        if(userLoggedIn()) {
            while($userDetailsResult = $userDetails->fetch()) {
                if($userDetailsResult["rechten"] <= 2) {
                    ?>
                        <form action="product.php?id=<?php echo $row["StockItemID"]; ?>" method="post" enctype="multipart/form-data">
                            <input type="file" name="fileToUpload" id="fileToUpload"><br>
                            <input type="submit" value="Upload Foto" name="submitUploadPic">
                        </form>
                    <?php
                }
            }
        }
    ?>
</div>