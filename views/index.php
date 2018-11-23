<?php
/*
include_once 'package.inc.php';
include $template;
$stmt = $pdo->query("SELECT * FROM stockitems");
$stmt->execute();
*/
?>

<!-- Slideshow container -->
<div class="slideshow-container">

  <!-- Full-width images with number and caption text -->
  <div class="mySlides ">
    <div class="numbertext">1 / 9</div>
    <img src="https://via.placeholder.com/1260" class="img">
    <div class="text">Aanbieding 1</div>
  </div>

  <div class="mySlides">
    <div class="numbertext">2 / 9</div>
    <img src="https://via.placeholder.com/250" class="img">
    <div class="text">Aanbieding 2</div>
  </div>

  <div class="mySlides">
    <div class="numbertext">3 / 9</div>
    <img src="https://via.placeholder.com/250" class="img">
    <div class="text">Aanbieding 3</div>
  </div>
  
   <div class="mySlides ">
    <div class="numbertext">4 / 9</div>
    <img src="https://via.placeholder.com/250" class="img">
    <div class="text">Aanbieding 4</div>
  </div>

  <div class="mySlides">
    <div class="numbertext">5 / 9</div>
    <img src="https://via.placeholder.com/250" class="img">
    <div class="text">Aanbieding 5</div>
  </div>

  <div class="mySlides">
    <div class="numbertext">6 / 9</div>
    <img src="https://via.placeholder.com/250" class="img">
    <div class="text">Aanbieding 6</div>
  </div>
  
   <div class="mySlides ">
    <div class="numbertext">7 / 9</div>
    <img src="https://via.placeholder.com/250" class="img">
    <div class="text">Aanbieding 7</div>
  </div>

  <div class="mySlides">
    <div class="numbertext">8 / 9</div>
    <img src="https://via.placeholder.com/250" class="img">
    <div class="text">Aanbieding 8</div>
  </div>

  <div class="mySlides">
    <div class="numbertext">9 / 9</div>
    <img src="https://via.placeholder.com/250" class="img">
    <div class="text">Aanbieding 9</div>
  </div>

  <!-- Next and previous buttons -->
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
  
  
  
  <div class="btn-group" role="group" aria-label="Basic example">
  <button type="button" class="btn btn-secondary" onclick="currentSlide(1)">Aanbieding 1</button>
  <button type="button" class="btn btn-secondary" onclick="currentSlide(2)">Aanbieding 2</button>
  <button type="button" class="btn btn-secondary" onclick="currentSlide(3)">Aanbieding 3</button>
  <button type="button" class="btn btn-secondary" onclick="currentSlide(4)">Aanbieding 4</button>
  <button type="button" class="btn btn-secondary" onclick="currentSlide(5)">Aanbieding 5</button>
  <button type="button" class="btn btn-secondary" onclick="currentSlide(6)">Aanbieding 6</button>
  <button type="button" class="btn btn-secondary" onclick="currentSlide(7)">Aanbieding 7</button>
  <button type="button" class="btn btn-secondary" onclick="currentSlide(8)">Aanbieding 8</button>
  <button type="button" class="btn btn-secondary" onclick="currentSlide(9)">Aanbieding 9</button>
</div>
</div>
<br>

<!-- The dots/circles -->
<!--<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>-->


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










<?php
/*

<?php
$postNumber = 0;
$postRowDiv = 1;
?>
<div class="container push-padding">
    <?php
    if (isset($_GET['search'])) {
        echo "<h2>" . $_GET['search'] . "</h2>";
    }

    sortProducts();
    ?>
    <table class="table table-bordered tableHistory tableHistory1">
        <tr>
            <th><b>Nummer:</b></th>
            <th><b>Naam:</b></th>
            <th><b>Aantal:</b></th>
            <th><b>Voeg toe aan winkelmand:</b></th>
        </tr>
        <?php
        $i = 1;
        $countRows = 0;
        while ($singleStockItem = $stockItems->fetch()) {
            $postNumber++;
            $countRows++;
            if ($postNumber > 20) {
                $postNumber = 1;
                $postRowDiv++;
                ?>
            </table>
            <table class="table table-bordered tableHistory tableHistory<?php echo $postRowDiv; ?>">
                <tr>
                    <th><b>Nummer:</b></th>
                    <th><b>Naam:</b></th>
                    <th><b>Aantal:</b></th>
                    <th><b>Voeg toe aan winkelmand:</b></th>
                </tr>
                <?php
            }
            $stockCount = $stockItems->rowCount();
            ?>
            <tr>
                <th><b><?php echo $countRows; ?></b><?php echo ". "; ?></th>
                <th><a href="product.php?id=<?php echo $singleStockItem["StockItemID"]; ?>"><?php echo $singleStockItem["StockItemName"]; ?></a></th>
                <th><input type="number" name="hoeveel" min="0" placeholder="<?php echo getCartTotal($singleStockItem["StockItemID"]); ?>" value="<?php echo getCartTotal($singleStockItem["StockItemID"]); ?>" class="numberWinkelmand numberWinkelmand<?php echo $singleStockItem["StockItemID"]; ?>"></th>
                <th><input type="submit" name="submitWinkelmand" class="submitWinkelmand" data-id="<?php echo $singleStockItem["StockItemID"]; ?>"></th>
            </tr>
            <?php
        }
        ?>
    </table>
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
    <br>
</div><br>
*/
?>