<?php 
session_start();
require_once('includes/connection.php');
require_once('includes/Items.php');

$item = new Item;
$items = $item->fetch_all();

function pre_r($data){
    echo "<pre>";
    echo print_r($data);
    echo "</pre>";
}

if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "add":
            if(!empty($_POST["quantity"])){
                $productByCode = $item->fetchByCode($_GET['code']);

                // create array object
                $itemArray = array($productByCode["code"]=>
                                array('name'=>$productByCode["name"], 
                                        'code'=>$productByCode["code"], 
                                        'quantity'=>$_POST["quantity"], 
                                        'price'=>$productByCode["price"], 
                                        'image'=>$productByCode["image"]
                                    )
                                );

                if(!empty($_SESSION["cart_item"])) {
                    // find if new item already in cart
                    if(in_array($productByCode["code"],array_keys($_SESSION["cart_item"]))) {     
                        // find that item on cart                 
                        foreach($_SESSION["cart_item"] as $itemCart){
                            if($itemCart['code'] == $productByCode["code"]){
                                // add quantity to item on cart
                                $_SESSION["cart_item"][$itemCart['code']]['quantity'] += $_POST['quantity'];
                            }
                        }
                    } 
                    // new item add to cart
                    else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }

            }
            break;

        case "remove":
            if(!empty($_SESSION["cart_item"])) {
                foreach($_SESSION["cart_item"] as $itemCart) {
                    if($_GET['code'] == $itemCart['code']){
                        unset($_SESSION["cart_item"][$itemCart['code']]);
                    }
                    if(empty($_SESSION["cart_item"])){
                        unset($_SESSION["cart_item"]);
                    }
                }
            }
            break;

        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}