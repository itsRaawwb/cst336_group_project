<?php

include 'includes/database.php'

$conn = getDatabaseConnection();

if(isset($_GET['productId'])){
   SELECT productName, productDescription
    FROM ProductDescription WHERE productId = " . $_GET['productId'];
	$records = getDataBySQL($sql);
	foreach ($records as $record) {
		echo "ProductName: " . $record['productName'] . "<br />";
		echo "ProductDescription: " . $record['productDescription'] . "<br />";
	}
}

?>