<!DOCTYPE html>
<?php 
include 'includes/database.php'
?>
<html>
    <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width">
            <title>Checkout</title>
            <link rel="shortcut icon" href="https://csumb.edu/sites/default/files/pixelotter.png" type="image/png">
            <link rel="stylesheet" type="css" href="css/main.css">
        
    </head>
    <body>
<?php
    session_start();
    $page_title = "checkout";
    
    $action = isset($_GET['action']) ? $_GET['action'] : "";
    $name = isset($_GET['name']) ? $_GET['name'] : "";
    
    if($action=='removed'){
        echo "<div class='alert alert-info'>";
            echo "<strong>{$name}</strong> was removed from your cart";
        echo "</div>";
    }
    else if($action=='quantity_updated'){
        echo "<div class='alert alert-info'>";
         echo "<strong>{$name}</strong> quantity was updated!";
        echo "</div>";
    }
    
    
    
    if(count($_SESSION['cart_items'])>0){
 
        // get the product ids
        $ids = "";
        foreach($_SESSION['cart_items'] as $id=>$value){
            $ids = $ids . $id . ",";
        }
     
        // remove the last comma
        $ids = rtrim($ids, ',');
     
        //start table
        echo "<table class='table'>";
     
            // our table heading
            echo "<tr>";
                echo "<th class='tableText'>Product Name</th>";
                echo "<th>Price (USD)</th>";
                echo "<th>Action</th>";
            echo "</tr>";
     
            $query = "SELECT ProductID, ProductName, ProductCost FROM products WHERE id IN ({$ids}) ORDER BY name";
     
            $stmt = $con->prepare( $query );
            $stmt->execute();
     
            $total_price=0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
     
                echo "<tr>";
                    echo "<td>{$name}</td>";
                    echo "<td>&#36;{$price}</td>";
                    echo "<td>";
                        echo "<a href='remove_from_cart.php?id={$id}&name={$name}'>";
                            echo "<span'></span> Remove from cart";
                        echo "</a>";
                    echo "</td>";
                echo "</tr>";
     
                $total_price+=$price;
            }
     
            echo "<tr>";
                    echo "<td><b>Total</b></td>";
                    echo "<td>&#36;{$total_price}</td>";
                    echo "<td>";
                        echo "<a>";
                            echo "<span></span> Checkout";
                        echo "</a>";
                    echo "</td>";
                echo "</tr>";
     
        echo "</table>";
    }
     
    else{
        echo "<div'>";
            echo "<strong>No products found</strong> in your cart!";
        echo "</div>";
    }
?>
    </body>
</html>

