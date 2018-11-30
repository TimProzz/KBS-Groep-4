<?php
    include_once "package.inc.php";
    $views = "views/product.php";
?>

<?php
    if(isset($_POST["submitYoutubeLink"]) && userLoggedIn()) {
        $postID = $_GET["id"];
        $youtubelink = $_POST["linkToSubmit"];
        $countIfResult = 0;
                
                $stmt = $pdo->query("SELECT * FROM productimages WHERE productid = '" . $postID . "'");
                while($row = $stmt->fetch()) {
                    $countIfResult++;
                } 
                if($countIfResult > 0) {
                    $queryInsertVid = ("UPDATE productimages SET videolink='" . $youtubelink . "' WHERE productid= '". $postID. "'");
                } else {
                    $queryInsertVid = ("INSERT INTO productimages (productid, videolink) VALUES ('".$postID."', '".$youtubelink."')");
                }
                $queryInsertVidChange = $pdo->prepare( $queryInsertVid );
                $queryInsertVidChange->execute();
    }
    if(isset($_POST["submitUploadPic"]) && userLoggedIn()) {
        $target_dir = "uploads/";
        
        $date = new DateTime();
        $result = $date->format('dmYHis');
        
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        //$target_file = $target_dir . $result;
        echo $target_file;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if(isset($_POST["submitUploadPic"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "Bestand is een foto - " . $check["mime"] . ".";?><br><?php
                $uploadOk = 1;
            } else {
                echo "Bestand is geen foto";?><br><?php
                $uploadOk = 0;
            }
        }
        if (file_exists($target_file)) {
            echo "Bestand bestaat al";?><br><?php
            $uploadOk = 0;
        }
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            echo "Bestand te groot";?><br><?php
            $uploadOk = 0;
        }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Upload alleen JPG, PNG, JPEG of GIF bestanden.";?><br><?php
            $uploadOk = 0;
        }
        $bestandsNaam = $result . "." . $imageFileType;
        if ($uploadOk == 0) {
            echo "Bestand niet geupload.";?><br><?php
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $bestandsNaam)) {
                echo "Bestand ". $bestandsNaam. " geupload.";?><br><?php
                $postID = $_GET["id"];
                $countIfResult = 0;
                
                $stmt = $pdo->query("SELECT * FROM productimages WHERE productid = '" . $postID . "'");
                while($row = $stmt->fetch()) {
                    $countIfResult++;
                }
                
                if($countIfResult > 0) {
                    $queryInsertPic = ("UPDATE productimages SET imageName='" . $bestandsNaam . "' WHERE productid= '". $postID. "'");
                } else {
                    $queryInsertPic = ("INSERT INTO productimages (productid, imageName) VALUES ('".$postID."', '".$bestandsNaam."')");
                }
                
                $queryInsertPicChange = $pdo->prepare( $queryInsertPic );
                $queryInsertPicChange->execute();

                echo "Bestand gezet in database 'stockitems'";
            } else {
                echo "Probleempie, probeer opnieuw";
            }
        }
    }
?>

<?php
    $stmt = $pdo->prepare("SELECT * FROM StockItems S
                    JOIN stockitemstockgroups SG ON S.StockItemID = SG.StockItemID
                    JOIN stockitemholdings SH ON S.StockItemID = SH.StockItemID
                    JOIN stockgroups G ON SG.StockGroupID = G.StockGroupID
                    LEFT JOIN productimages PI ON S.StockItemID = PI.productid
                    WHERE S.StockItemID = " . $_GET['id']);

    // uitvoeren
    $stmt->execute();
    $row = $stmt->fetch();
?>

<?php
    include $template;
?>