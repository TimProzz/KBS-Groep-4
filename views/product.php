<div class="container product">
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
            <?php
            echo '<img class="img-fluid" src="' . $row["Photo"] . '">'; 
            ?>
            <img class="img-fluid" src="assets/images/strand-badeend.jpg">
        </div>
        <div class="col-lg-6 productInfo">
            <h5 class="card-title">
                <?php echo $row["StockItemName"]; ?>
            </h5>
            <p class="card-text mb-2 text-muted">
               <?php echo $row["MarketingComments"]; ?>
            </p>
            <h6 class="card-subtitle mb-2 text-muted">
                &euro;<?php echo $row["UnitPrice"]; ?>
            </h6>
            <p class="card-text">
                <?php while ($cat = $stmt->fetch()) { ?>
                    <a href="categorie.php?id=<?php echo $cat["StockGroupID"]; ?>">
                        <?php echo $cat["StockGroupName"]; ?>
                    </a>
                    ,
                <?php } ?>
            </p>
            <input type="number" name="hoeveel" min="0" placeholder="<?php echo getCartTotal($row["StockItemID"]); ?>" value="<?php echo getCartTotal($row["StockItemID"]); ?>" class="numberWinkelmand numberWinkelmand<?php echo $row["StockItemID"]; ?>">
            <a href="#" class="btn btn-primary submitWinkelmand" data-id="<?php echo $row["StockItemID"]; ?>">In Winkelmand</a>
        </div>
    </div>
</div>