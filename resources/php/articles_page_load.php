<?php
require __DIR__."/db_connection/connection.inc.php";
$search = $_POST['search-product'];         //holt sich String aus dem Selektieren Feld
$sql = "SELECT * FROM DDSprodukte;";

if(isset($search)) {
	$sql = "SELECT * FROM DDSprodukte WHERE pname LIKE '%$search%'";       //holt sich aus DB Produkte mit search Pattern
}

$result = mysqli_query($db, $sql);

while ($myrow = mysqli_fetch_array($result)) { ?>                               
		
		<form action=<?php echo $_SERVER['PHP_SELF']; ?> method='POST'>   <!--postet alle selektierten Produkte-->
		<div class='product-row' name='product-table' border=1>
		<div name='product-num' class='product-item col s2'><?php echo $myrow['produktid']; ?></div>
		<div name='product-name' class='product-item col s2'><?php echo $myrow['pname']; ?></div>
		<div name='product-description' class='product-item col s2'><?php echo $myrow['pbeschreibung']; ?></div>
		<div name='product-pic' class='product-item col s2'><?php echo $myrow['pbild']; ?></div>
		<div name='product-price' class='product-item col s1'><?php echo $myrow['verkaufspreis']; ?> €</div>
		<div class='product-item col s1'><input type='text' class='product-count' name='product-count' placeholder=<?php echo $myrow['mengelager']; ?>></div>
		<div class='product-item col s2'><input type='submit' class='product-item-submit' name=<?php echo $myrow['produktid']; ?> value='in den Warenkorb'/></div>
		</div>
		</form>
		<?php
}


?>
