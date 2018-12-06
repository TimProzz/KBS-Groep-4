<?php
    $postNumber = 1;
    $postRowDiv = 1;
?>

<div class="container push-padding">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php echo $row["StockGroupName"]; ?>
            </li>
        </ol>
    </nav>
    <?php
        sortProducts();
    ?>
    <div class="row"> 
        <div class="tableHistory tableHistory1">
        <?php
            $i = 1;
            $countRows = 0;
            while ($row = $stockItems->fetch()) {
                ?>
                    <div class='col col-md-3 artikel'> 
                        <div class='card'>
                            <div class="card-image">
                                <img style="max-heigth: 250px; " class="card-img-top" src="<?php if(!empty($row["imageName"])) { echo 'uploads/' . $row["imageName"]; } else { echo 'https://via.placeholder.com/250'; } ?>" alt="Card image cap">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><a href="product.php?id=<?php echo $row['StockItemID']; ?>"><?php echo $row["StockItemName"]?></a></h5>
                              <p class="card-text"><?php echo $row["MarketingComments"]?></p>
                                <p class="card-supply"><?php 
                                if(isset($row["QuantityOnHand"]) && $row["QuantityOnHand"] >= 10) { 
                                    echo "Voorraad: <span class='SupplyHigh'>10+</span>"; 
                                } elseif (isset($row["QuantityOnHand"]) && $row["QuantityOnHand"] < 10 && $row["QuantityOnHand"] > 0) {
                                    echo "Voorraad: <span class= 'SupplyLow'>" . $row["QuantityOnHand"] . "</span>"; 

                                } elseif(isset($row["QuantityOnHand"]) && $row["QuantityOnHand"] <= 0) { 
                                    echo "<span class= 'SupplyLow'> Product uitverkocht! </span>"; 

                                } ?>
                               </p>
                              <h6 class="price">&euro;<?php echo $row["RecommendedRetailPrice"]?></h6>
                              <!--<a href="#" class="btn btn-primary wagen">In winkelwagen</a>-->
                            </div>
                        </div>
                    </div>
                <?php
                $postNumber++;
                $countRows++;
                if ($postNumber > 20) {
                    $postNumber = 1;
                    $postRowDiv++;
                    ?>
                    </div>
                    <div class="tableHistory tableHistory<?php echo $postRowDiv; ?>"><?php
                }
            }
        ?>
        </div>
        <div class="pageSelect">
            <button class="buttonPageSelect buttonPrev" id="prevButton">Previous</button>
            <div class="pageSelectInner">
                <?php
                for ($i = 1; $i <= $postRowDiv; $i++) {
                    ?><a class="linkReactPage reactionPageNumber<?php echo $i; if($i == 1) { echo ' pageSelected'; } ?>" id="tableHistory<?php echo $i; ?>"><?php echo $i; ?></a><?php
                }
                ?>
            </div>
            <button class="buttonPageSelect buttonNext" id="nextButton">Next</button>
        </div>
    </div>

</div>