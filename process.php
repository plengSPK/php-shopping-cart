<?php 

require_once('includes/connection.php');
require_once('includes/Items.php');

$item = new Item;
$items = $item->fetch_all();

function pre_r($data){
    echo "<pre>";
    echo print_r($data);
    echo "</pre>";
}

