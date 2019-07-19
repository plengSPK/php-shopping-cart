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
                $_SESSION["cart_item"] = $itemArray;
            }
            break;

        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}