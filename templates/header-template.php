<html>
    <head>
        <title>Badeend&co</title>
        <link rel="icon" href="assets/images/SM-Rubber-Duck-front-Amsterdam-Duck-Store.jpg">

        <link rel="stylesheet" href="assets/css/main.css" />
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
        <script type="text/javascript" src="assets/js/main.js"></script>
        <script type="text/javascript" src="assets/js/jquery.cookie.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar-fixed">
            <div class="singleMenuItem">
                <a href="index.php"><div class="logo-img" style="background: url('assets/images/logo.png') no-repeat 50%;"></div></a>
            </div>
            <div class="singleMenuItem">
                <form class="form-inline my-2 my-lg-0 search-form" method="get" action="search.php">
                    <input class="form-control mr-sm-2 search-form-style" type="search" name="search" placeholder="<?php if(isset($_COOKIE["login"])) { echo 'Hoi ' . $_COOKIE['login'] . ', waar ben je naar opzoek?'; } else { echo 'Waar ben je naar opzoek?'; } ?>" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
            <div class="singleMenuItem specialNavBar">
                <div class="singleMenuItemContent">
                    <a class="nav-link singleLink" href="winkelmand.php">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="winkelmandCount winkelmandStyle"><?php echo countCartTotal(); ?></span>
                    </a>
                    <a class="nav-link singleLink" href="<?php if(isset($_COOKIE["login"])) { echo 'account.php'; } else { echo 'login.php'; } ?>">
                        <?php if(isset($_COOKIE["login"])) { echo "<span class='navUserName'>" . $_COOKIE["login"] . "</span>"; } ?><i class="fa fa-user" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg navbar-light bg-light push">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto navbar-fix">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
                    </li>



                    <?php
                    $headerStockGroups = $pdo->prepare("SELECT * FROM StockGroups");

                    // uitvoeren
                    $headerStockGroups->execute();
                    while ($headerRow = $headerStockGroups->fetch()) {
                        ?>

                        <li class="nav-item">
                            <a class="nav-link" href="categorie.php?id=<?php echo $headerRow["StockGroupID"]; ?>">
                                <?php echo $headerRow["StockGroupName"]; ?>
                            </a>
                        </li>

                        <?php
                    }
                    ?>
                </ul>
            </div>
        </nav>
        <?php
        if(userLoggedIn()) {
            ?>
            <div class="loggedIn"><?php echo "Logged in as <a href='account.php'>" . $_COOKIE["login"] . "</a> - <a href='logout.php'>Logout</a>"; ?></div>
            <?php
        }
        ?>