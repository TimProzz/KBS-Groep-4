<?php
include("template.php");
?>

<?php
$stmt = $pdo->prepare("SELECT * FROM StockItems S
                JOIN stockitemstockgroups SG ON S.StockItemID = SG.StockItemID
                JOIN stockgroups G ON SG.StockGroupID = G.StockGroupID
                WHERE S.StockItemID = " . $_GET['id']);

// uitvoeren
$stmt->execute();
$row = $stmt->fetch();
?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="background-color: white;">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">
            <a href="categorie.php?id=<?php echo $row["StockGroupID"]; ?>">
                <?php echo $row["StockGroupName"]; ?>
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <?php echo $row["StockItemName"]; ?>
        </li>
    </ol>
</nav>

<div style="text-align: center; padding-top: 50px;">

    <div class="card" style="width: 18rem; display: inline-block">
        <img class="card-img-top" src="assets/images/SM-Rubber-Duck-front-Amsterdam-Duck-Store.jpg" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">
                <?php echo $row["StockItemName"]; ?>
            </h5>
            <h6 class="card-subtitle mb-2 text-muted">
                &euro;<?php echo $row["UnitPrice"]; ?>
            </h6>
            <p class="card-text">
                <?php while ($cat = $stmt->fetch()) { ?>
                    <a href="categorie.php?id=<?php echo $cat["StockGroupID"]; ?>">
                        <?php echo $cat["StockGroupName"]; ?>
                    </a>
                    ,
                <?php } ?>
            </p>
            <a href="#" class="btn btn-primary">In Winkelwagen</a>
        </div>
    </div>
</div>
</body>
</html>

