<?php

    include("template.php");

?>

<?php

    //if(isset($_POST["productToAddID"])) {
        //$data = $_POST['data'] or $_REQUEST['data'];
        //json_decode($data);
        
        //$productToAddID = $_POST["productToAddID"];
        //$numberToAdd = $_POST["numberToAdd"];

        $productToAddID = 1;
        $productToAddID1 = 2;
        $numberToAdd = 5;
        $numberToAdd1 = 6;

        //$data = '{"list":[{"productID":'.$productToAddID.',"numberToAdd":'.$numberToAdd.'},{"productID":'.$productToAddID1.',"numberToAdd":'.$numberToAdd1.'}';
        $data = [{"productID":$productToAddID,"numberToAdd":$numberToAdd}];
        $json = json_decode($data);
        
    //}

?>