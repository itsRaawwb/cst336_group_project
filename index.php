<!--Testing a push-->
<?php

include 'includes/database.php';

$conn = getDatabaseConnection();

#function that returns all products in the Product table
function displayAllProducts() {
    $sql = "SELECT ProductName, ProductCost, productId FROM Product";
    $records = getDataBySQL($sql);
    return $records;
}


function isHealthyChoiceChecked() 
{

	if (isset($_GET['healthyChoice'])) 
	{
		return "checked";
	}

}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Team Project</title>
		
		<link href="./Lab 5_ Otter Express - Product Catalog_files/styles.css" rel="stylesheet">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

    </head>
    <body>
        <header>
            <h1>Otter Express Online</h1>
        </header>

        <form method = "get" action = "index.php">
            Select Category:
            <select name = "categoryId">
                <!-- this will come from database -->
            </select>
            
            Max Price:
            <input type="number" min="0" name="maxPrice" value=="<?=$_GET['maxPrice'] ?>">
            
            <input type="checkbox" name="healthyChoice" id="healthyChoice"  <?=isset($_GET['healthyChoice']) ? "checked" : "" ?> />
				<label for="healthyChoice">Healthy Choice</label>

				OrderBy:
				<select name="orderBy">
					<option value="price">Price</option>
					<option value="productName">Name</option>

				</select>
				<br />
				<input type="submit" value="Search Products" name="searchForm" />
			</form>

        <footer>
            <br>
            CST 336 Team Project
            Robert Macias
            Harrison Oglesby
            Spring 2016
            
        </footer>
    </body>
</html>