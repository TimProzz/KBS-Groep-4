<html>
    <head>
        <title>Wollah</title>
        
        <link rel="stylesheet" href="assets/css/main.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
        <script type="text/javascript" src="assets/js/main.js"></script>
    </head>
    <body>
    
    
    </body>
</html>

<?php

    include("template.php");

?>

<?php

    //Dit is het index bestand voor KBS-Groep-4.2

    //echo "Djordy zorgt voor de foto's van badeenden :( slecht ideeeeeee";

?>

<?php

    $stockItems = $pdo->query("SELECT * FROM stockitems");

?>

<?php
    $postNumber = 0;
    $postRowDiv = 1;
?>
<div style="overflow-x: auto;">
    <table class="tableHistory tableHistory1">
        <tr>
            <th><b>Nummer:</b></th>
            <th><b>Naam:</b></th>
            <th><b>Niks:</b></th>
            <th><b>Niks:</b></th>
        </tr>
        <?php
            $i = 1;
            $countRows = 0;
            while($singleStockItem = $stockItems->fetch()) {
                $postNumber++;
                $countRows++;
                if($postNumber > 20) { 
                    $postNumber = 1;
                    $postRowDiv++;
                    ?>
                    </table>
                    <table class="tableHistory tableHistory<?php echo $postRowDiv;?>">
                        <tr>
                            <th><b>Nummer:</b></th>
                            <th><b>Naam:</b></th>
                            <th><b>Niks:</b></th>
                            <th><b>Niks:</b></th>
                        </tr>
                    <?php
                }
                $stockCount = $stockItems->rowCount();
                ?>
                <tr>
                    <th><b><?php echo $countRows; ?></b><?php echo ". ";?></th>
                    <th><?php echo $singleStockItem["StockItemName"];?> </th>
                    <th></th>
                    <th></th>
                </tr>
            <?php
            }
        ?>
    </table>
</div><br>
<div class="pageSelect">
    <?php 
    echo "Pagina: ";
    for($i = 1; $i <= $postRowDiv; $i++) {
        ?><a class="linkReactPage reactionPageNumber<?php echo $i; ?>" id="tableHistory<?php echo $i; ?>"><?php echo $i; ?></a><?php
    }
    ?>
</div><br>
