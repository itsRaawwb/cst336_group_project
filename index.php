<!--Testing a push-->
<?php

include 'includes/database.php';

$conn = getDatabaseConnection();

//function that returns all products in the Product table
function displayAllProducts() {
    $sql = "SELECT 'ProductName', 'ProductCost', 'ProductID' FROM 'products'";
    $records = getDataBySQL($dbConn, $sql);
    return $records;
}


function isHealthyChoiceChecked() 
{

	if (isset($_GET['healthyChoice'])) 
	{
		return "checked";
	}

}

function displayCategories() 
{
	$sql = "SELECT categoryId, categoryName
        	FROM oe_category WHERE 1";
			
	$records = getDataBySQL($sql);
	
	foreach ($records as $record) 
	{
		echo "<option value = '" . $record['categoryId'] . "'>" . $record['categoryName'] . "</option>";
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
			
			<hr>
			<br />
			<div style="float:left">
				<?php

				//Displays all products by default
				if (!isset($_GET['searchForm'])) 
				{
					$records = displayAllProducts();
				} 
				else 
				{
					$records = filterProducts();
				}

				echo "<table border = 1>";
				echo "<tr>";
				echo "<td id = 'colTitle'>";
				echo "Name";
				echo "</td>";
				echo "<td id = 'colTitle'>";
				echo "Price";
				echo "</td>";
				echo "</tr>";

				foreach ($records as $record) 
				{
					echo "<tr>";
					echo "<td>";
					echo "<a target = 'getProductIframe' href='getProductInfo.php?productId=" . $record['productId'] . "'>";
					echo $record['productName'];
					echo "</a>";
					echo "</td>";
					echo "<td>";
					echo "$ " . $record['price'];
					echo "</td>";
					echo "</tr>";
				}
				echo "</table>";
				?>
			</div>
			<div style="float:left">

				<iframe src="getProductInfo.php" name="getProductIframe" width="250" height="300" frameborder="0"/></iframe>

			</div>



        <footer>
            <br>
            CST 336 Team Project
            Robert Macias
            Harrison Oglesby
            Spring 2016
            
        </footer>
    </body>
</html>