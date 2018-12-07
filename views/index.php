<!-- Slideshow container -->
<div class="slideshow-container">
    <?php
        $sliderImages = array();
        while($rowSliderImagesDB = $sliderImagesDB->fetch()) {
            $sliderImages = explode(",", $rowSliderImagesDB["stringImages"]);
        }
        
        //$sliderImages = array("https://via.placeholder.com/250", "https://via.placeholder.com/1250", "https://s.s-bol.com/imgbase0/imagebase3/large/FC/2/4/4/4/9200000085994442.jpg");
        $countSliders = count($sliderImages);
        if($countSliders == 0) {
            $countSliders = 1;
        }
        $widthButtons = 100 / $countSliders;
        $sliderImagesCount = 0;
        foreach($sliderImages as $singleSlide) {
            $sliderImagesCount++;
            ?>
                <div class="mySlides">
                    <div class="numbertext"><?php echo $sliderImagesCount . " / " . count($sliderImages); ?></div>
                    <?php /*<img src="<?php echo $singleSlide; ?>" class="img"> */?>
                    <div class="thesliderImage" style="background: url(<?php echo $singleSlide; ?>) 50% 50% no-repeat; background-size: cover; height: 300px;"></div>
                    <div class="text">Aanbieding <?php echo $sliderImagesCount; ?></div>
                </div>
            <?php
        }
    ?>
    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
    
    <div class="btn-group buttons-slider" role="group" aria-label="Basic example">
        <?php
            $sliderImagesCount = 0;
            foreach($sliderImages as $singleSlide) {
                $sliderImagesCount++;
                ?>
                    <button type="button" class="btn btn-secondary button-slider" style="width: <?php echo $widthButtons . "%"; ?>" onclick="currentSlide(<?php echo $sliderImagesCount; ?>)">Aanbieding <?php echo $sliderImagesCount; ?></button>
                <?php
            }
        ?>
    </div>
</div>
<br>

<?php
    $postNumber = 1;
    $postRowDiv = 1;
?>

<div class="container push-padding">
    <?php
        if (isset($_GET['search'])) {
            echo "<h2>" . $_GET['search'] . "</h2>";
        }

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