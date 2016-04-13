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
            <link rel="stylesheet" type="css" href="css/style.css">
        
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
    
    
    
    if(count($_SESSION['ids'])>0){

        //start table
        echo "<table>";
     
            // our table heading
            echo "<tr>";
                echo "<th>Product Name</th>";
                echo "<th>Price</th>";
            echo "</tr>";
     
            $x = 0;
            foreach($_SESSION['ids'] as $row){
                echo "<tr>";
                echo "<td>".$_SESSION['names'][$x];
                echo "</ td>";
                echo "<td>". $_SESSION['cost'][$x];
                echo"</td>";
                $x++;
            } 
           
     
     
            echo "<tr class='total'>";
                    echo "<td><b>Total</b></td>";
                    echo "<td>".$_SESSION["totalCost"]."</td>";
                echo "</tr>";
     
        echo "</table>";
    }
     
    else{
        echo "<div'>";
            echo "<strong>No products found</strong> in your cart!";
        echo "</div>";
    }
    
    echo '<a href="destroy.php">';
    echo "Checkout and Start New Order! YUM!";
    echo '</a>';
?>
    </body>
</html>

