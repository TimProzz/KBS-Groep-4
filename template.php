<?php
session_start();
include('connection.php');
?>

<html>
    <head>
        <title>Badeend&co</title>

        <link rel="stylesheet" href="assets/css/main.css" />
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
        <script type="text/javascript" src="assets/js/main.js"></script>
        <script type="text/javascript" src="assets/js/jquery.cookie.js"></script>
        <link rel="icon" href="assets/images/SM-Rubber-Duck-front-Amsterdam-Duck-Store.jpg">

    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
                    </li>



                    <?php
                    $stmt = $pdo->prepare("SELECT * FROM StockGroups");

                    // uitvoeren
                    $stmt->execute();
                    while ($row = $stmt->fetch()) {
                        ?>

                        <li class="nav-item">
                            <a class="nav-link" href="categorie.php?id=<?php echo $row["StockGroupID"]; ?>">
                                <?php echo $row["StockGroupName"]; ?>
                            </a>
                        </li>

                        <?php
                    }
                    ?>
            </div>
        </nav>



