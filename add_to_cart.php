<?php
session_start();
 
// get the product id
$id = isset($_GET['id']) ? $_GET['id'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
$cost = isset($_GET['cost']) ? $_GET['cost'] : "";



echo $id. $name .$cost;
 
 
 
 
/*
 * check if the 'cart' session array was created
 * if it is NOT, create the 'cart' session array
 */
if(!isset($_SESSION['ids'])){
    $_SESSION['ids'] = array();
}

if(!isset($_SESSION['names'])){
    $_SESSION['names'] = array();
}

if(!isset($_SESSION['cost'])){
    $_SESSION['cost'] = array();
}
if(!isset($_SESSION['totalCost'])){
    $_SESSION['totalCost'] = 0;
}
 
// // check if the item is in the array, if it is, add quantity
if(array_key_exists($id, $_SESSION['ids'])){
    
    array_push($_SESSION['ids'], $id);
    array_push($_SESSION['names'], $name);
    array_push($_SESSION['cost'], $cost);
    $_SESSION['totalCost'] += $cost;
    
    // redirect to product list and tell the user it was added to cart
    header('Location: index.php?action=added&id' . $id . '&name=' . $name);
}
 
// else, add the item to the array
else{
    array_push($_SESSION['ids'], $id);
    array_push($_SESSION['names'], $name);
    array_push($_SESSION['cost'], $cost);
    $_SESSION['totalCost'] += $cost;
    
    // redirect to product list and tell the user it was added to cart
    header('Location: index.php?action=added&id' . $id . '&name=' . $name);
}
?>