<!--Testing a push-->
<?php

include 'includes/database.php';

$conn = getDatabaseConnection();

//function that returns all products in the Product table
function displayAllProducts() {
	global $conn;
    $sql = "SELECT `ProductID`, `ProductName`, `ProductCost`, `ProductDescription`, `categoryID`, `healthyChoice` FROM `products` WHERE 1";
    $records = getDataBySQL($conn, $sql);
    return $records;
}

function filterProducts() 
{
	global $conn;
	
	if (isset($_GET['searchForm'])) 
	{//user submitted the filter form

		//assign all the search options to variables
		$categoryId = $_GET['Category'];
		$maxProductCost = $_GET['maxProductCost'];
		


		$sql = "SELECT `ProductID`, `ProductName`, `ProductCost`, `ProductDescription`, `categoryID`, `healthyChoice` 
                FROM products
                WHERE ";
		//using Named Parameters (prevents SQL injection)

		$namedParameters = array();
		$namedParameters["categoryId"] = $categoryId;

		//checks to see if the user wants to see all
		if($categoryId !="0"){
			$sql .= "categoryID = $categoryId";
		} else {
			$sql .= "categoryID > 0";
		}
		
		//checks to see what the cost search parameters are
		if (empty($maxProductCost)) 
		{
			$maxProductCost = 50;
			//the user entered a max ProductCost value in the form
			$sql .= " AND ProductCost <= $maxProductCost";
			//using named parameters
			$namedParameters["ProductCost"] = $maxProductCost;
		}
		else{
			$sql .= " AND ProductCost <= $maxProductCost";	
			$namedParameters["ProductCost"] = $maxProductCost;
		}
		
		//checks for healthy
		if (isset($_GET['healthyChoice'])) 
		{
			$sql .= " AND healthyChoice = 1";
		}

		$orderByFields = array("ProductCost", "ProductName");
		$orderByIndex = array_search($_GET['orderBy'], $orderByFields);

		$sql .= " ORDER BY " . $orderByFields[$orderByIndex];

		$statement = $conn -> prepare($sql);
		$statement -> execute($namedParameters);
		$records = $statement -> fetchAll(PDO::FETCH_ASSOC);
		return $records;

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
		
		<link href="css/style.css" rel="stylesheet">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

    </head>
    <body>
        <header>
            <h1>Otter Express Online</h1>
        </header>

        <form method = "GET" action = "index.php">
            Select Category:
            <select name = "Category">
                <option value="0">All</option>
                <option value="1">Entree</option>
                <option value="6">Side</option>
                <option value="3">Beer</option>
                <option value="4">Wine</option>
                <option value="5">Cocktail</option>
                <option value="7">Drink</option>
                <option value="8">Salad</option>
                <option value="9">Meal</option>
            </select>
            <br>
            
            Max ProductCost: $
            <input type="number" min="0" max="50" name="maxProductCost" >
            <br>
            <input type="checkbox" name="healthyChoice" id="healthyChoice"  value="healthy" />
			<label for="healthyChoice">Healthy Choice</label>
			<br>
			
			Order By:
			<select name="orderBy">
			    <option value="ProductCost">ProductCost</option>
			    <option value="ProductName">Name</option>
			</select>
				<br />
				<input type="submit" value="Search Products" name="searchForm" />
			</form>
			
			<hr>
			<br />
			<div style="float:left">
				<?php
				
				$temp=0;

				//Displays all products by default
				if (!isset($_GET['searchForm'])) 
				{
					$records = displayAllProducts();
				} 
				else 
				{
					$records = filterProducts();
				}
				
				

 

				echo "<table class>";
				echo "<tr>";
				echo "<td id = 'colTitle'>";
				echo "Name";
				echo "</td>";
				
				echo "<td id = 'colTitle'>";
				echo "Product Cost";
				echo "</td>";
				
				
				echo "<td id = 'colTitle'>";
				// to prevent undefined index notice
				$action = isset($_GET['action']) ? $_GET['action'] : "";
				$name = isset($_GET['name']) ? $_GET['name'] : "";
				//Tell users an item was added
				if($action=='added'){
				        echo "<strong>{$name}</strong> was added to your cart!";
				}
				echo "</td>";
				echo "</tr>";

				foreach ($records as $record) 
				{
					
					$id = $record['ProductID'];
					$name = $record['ProductName'];
					$cost = $record['ProductCost'];
					$desc = $record['ProductDescription'];
					
					echo "<tr>";
					echo "<td>";
					echo "<a target='_blank' href='popup.php?id=".$desc."' onClick=\"window.open(this.href, 'popupwindow', width=400,height=300,scrollbars,resizable');return false;\">";
					echo $name;
					echo"</a>";
					echo "</td>";
					
					echo "<td class='right-align'>";
					echo $cost;
					echo "</td>";
					
					echo "<td class='order'>";
					echo "<a href=\"add_to_cart.php?id=$id&name=$name&cost=$cost\""; 
						echo "<span></span>Order Item";
					// echo "</a>";
					echo "</td>";
					
					echo "</tr>";
				}
				echo "</table>";

				echo '<a class="fakebutton" href="checkout.php">Checkout</a>';
				?>
			</div>
			
        <footer class="footer">
        	<hr>
            CST 336 Team Project<br />
            Robert Macias<br />
            Harrison Oglesby<br />
            Spring 2016<br />
            
        </footer>
    </body>
</html>