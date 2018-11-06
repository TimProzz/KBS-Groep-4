<?php

    function getCartTotal($productid) {
        $theCart = json_decode($_COOKIE["winkelmand"]);
        foreach($theCart->listW as $key => $value) {
            if($theCart->listW[$key]->productid == $productid) {
                return $theCart->listW[$key]->hoeveel;   
            }
        }
        return 0;
    }

?>