<?php
include("template.php");
?>
<html>
    <head>
        <title>Wollah</title>

        <link rel="stylesheet" href="assets/css/main.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
        <script type="text/javascript" src="assets/js/main.js"></script>
    </head>
    <body>

        <?php
        $stmt = $pdo->prepare("SELECT * FROM StockItems WHERE StockItemID = " . $_GET['id']);

        // uitvoeren
        $stmt->execute();
        $row = $stmt->fetch();
        ?>

        <div style="text-align: center;">
            <img src="assets/images/SM-Rubber-Duck-front-Amsterdam-Duck-Store.jpg" width="500" height="500" alt="SM-Rubber-Duck-front-Amsterdam-Duck-Store"/>
            <br>

            <?php
            $naam = $row["StockItemName"];
            print("Naam: " . $naam . "<br>");
            ?>
        </div>




    </body>
</html>

