<?php
    include_once "package.inc.php";
    $views = "views/index.php";
?>

<?php
    $stockItems = $pdo->query("SELECT * FROM StockItems");
?>


<?php
    include $template;
?>
