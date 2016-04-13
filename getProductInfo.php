<?php

include 'includes/database.php';

$conn = getDatabaseConnection();

if(isset($_GET['ProductID'])){
   "SELECT ProductName
    FROM products WHERE ProductId = " . $_GET['ProductID'];
	$records = getDataBySQL($sql);
	
	foreach ($records as $record) {
		// echo "Product Name: " . $record['ProductName'] . "<br />";
		// echo "Product Description: " . $record['ProductDescription'] . "<br />";
	}
} 

?>