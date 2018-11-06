<?php

    function getCartTotal($productid) {
        if(isset($_COOKIE["winkelmand"])) {
            $theCart = json_decode($_COOKIE["winkelmand"]);
            foreach($theCart->listW as $key => $value) {
                if($theCart->listW[$key]->productid == $productid) {
                    return $theCart->listW[$key]->hoeveel;   
                }
            }
        }
        return 0;
    }

    function countCartTotal() {
        $count = 0;
        if(isset($_COOKIE["winkelmand"])) {
            $theCart = json_decode($_COOKIE["winkelmand"]);
            foreach($theCart->listW as $key => $value) {
                $count += $theCart->listW[$key]->hoeveel;
            }
            return $count;
        }
        return 0;
    }
?>