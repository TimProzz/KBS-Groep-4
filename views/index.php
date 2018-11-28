<!-- Slideshow container -->
<div class="slideshow-container">
    <?php
        $sliderImages = array("https://via.placeholder.com/250", "https://via.placeholder.com/1250");
        $sliderImagesCount = 0;
        foreach($sliderImages as $singleSlide) {
            $sliderImagesCount++;
            ?>
                <div class="mySlides">
                    <div class="numbertext"><?php echo $sliderImagesCount . " / " . count($sliderImages); ?></div>
                    <img src="<?php echo $singleSlide; ?>" class="img">
                    <div class="text">Aanbieding <?php echo $sliderImagesCount; ?></div>
                </div>
            <?php
        }
    ?>
    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
    
    <div class="btn-group" role="group" aria-label="Basic example">
        <?php
            $sliderImagesCount = 0;
            foreach($sliderImages as $singleSlide) {
                $sliderImagesCount++;
                ?>
                    <button type="button" class="btn btn-secondary" onclick="currentSlide(<?php echo $sliderImagesCount; ?>)">Aanbieding <?php echo $sliderImagesCount; ?></button>
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