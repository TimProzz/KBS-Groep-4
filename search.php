<?php

include_once "package.inc.php";
$views = "views/index.php";
?>

<?php

$search = str_replace(" ", "%", $_GET["search"]);

$stockItems = $pdo->query("SELECT * FROM StockItems
            WHERE StockItemName LIKE '%" . $search . "%'");
?>


<?php

include $template;
?>