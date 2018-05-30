<?php
require __DIR__."/db_connection/connection.inc.php";

$addToCartButton = $_POST['product-submit'];
$shoppingcart = array();

if ((in_array("remove", $_POST))) { //remove button name ist gleich der produktid
	$key = array_search("remove", $_POST);
	$sql = "DELETE FROM DDSkundenbestellung WHERE produktid = '$key';";
	$result = mysqli_query($db, $sql);
	showCart($db);
}


if ((in_array("in den Warenkorb", $_POST))) {
	$articleCount = getArticleCount(); //POST von ProduktCOUNT
	if ($articleCount != 0) {
		newOrder($db, $articleCount);
		showCart($db);
	} else {
		echo "bitte Anzahl angeben!";
	}
}
function showCart($db) {
	$sql = "SELECT DDSprodukte.pname, DDSprodukte.verkaufspreis, DDSkundenbestellung.* FROM DDSkundenbestellung INNER JOIN DDSprodukte WHERE DDSprodukte.produktid = DDSkundenbestellung.produktid;"; // Select alles aus DDSKundenbestellung, wo die id gleich wie in DDSprodukte produkte ist, um zusätzliche Informationen zum produkt zu erhalten und im warenkorb darzustellen
	$result = mysqli_query($db, $sql);
	while ($myrow = mysqli_fetch_array($result)) {
		if ($myrow['status'] == 0) {
		?>
		
		<form action=<?php echo $_SERVER['PHP_SELF']; ?> method='POST'> <!-- darstellen der Produkt-->
		<li class='cart-item'>
		<div name='cart-item-name' class='cart-item-attr-title'><u><b>Produktname: </b></u><br><?php echo $myrow['pname'];?></div>
		<div name='cart-item-productnum' class='cart-item-attr'><u><b>Artikelnr.: </b></u><br><?php echo $myrow['produktid'];?></div>
        <div name='cart-item-price' class='cart-item-attr'><u><b>Verkaufspreis pro Stück: </b></u><br><?php echo $myrow['verkaufspreis'];?> €</div>
        <div name='cart-item-num' class='cart-item-attr'><u><b>Anzahl: </b></u><br><?php echo $myrow['anzahl'];?></div>
        <div name='cart-item-remove-field' class='cart-item-attr-submit'><input type='submit' name='<?php echo $myrow['produktid']; ?>' class='cart-item-remove-button' value='remove'></div>
        </li>
        </form>
        
		<?php
		}
	}
}

function newOrder($db, $articleCount) { //"Legt" bestellte Produkte in Warenkorb (DDSkundenbstellung, status ==0)
	$key = array_search("in den Warenkorb", $_POST);
	$sql = "SELECT * FROM DDSprodukte WHERE produktid = '$key';";
	$result = mysqli_query($db, $sql);
	$myrow = mysqli_fetch_array($result);
	$userid = $_SESSION['userid'];
	$sql = "INSERT INTO DDSkundenbestellung (userid, produktid, anzahl, status, bestandaktualisiert) VALUES ('$userid','$key','$articleCount','0', '0');";
	$result = mysqli_query($db, $sql);s
}	

function getArticleCount() {
	$articleCount = $_POST['product-count'];
	if ($articleCount == NULL) {
		return 0;
	}
	return $articleCount;
}




?>
