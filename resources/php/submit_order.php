<?php

require __DIR__."/db_connection/connection.inc.php";

if ((in_array("Bestellen", $_POST))) {      //JOIN um den Preis Anhand der ID des Produkts zu bekommen status=0-> in warenkorb
	$sql = "SELECT DDSprodukte.verkaufspreis, DDSkundenbestellung.* FROM DDSkundenbestellung INNER JOIN DDSprodukte WHERE DDSprodukte.produktid = DDSkundenbestellung.produktid AND DDSkundenbestellung.status = '0';";
	$result = mysqli_query($db, $sql);
	$totalsum = 0;
	while ($myrow = mysqli_fetch_array($result)) {
		$price = $myrow['verkaufspreis'];
		$priceProd = $price * $myrow['anzahl'];
		$totalsum += $priceProd;                               //setzten des Totalen EK
	}
	$alertText = "'Deine Bestellung wurde übermittelt. Die Rechnung beträgt ".$totalsum." €'"; // speichern des Alerttextes
	?>
	<script>alert(<?php echo $alertText; ?>);</script>
	
	<?php
	
	$sql = "UPDATE DDSkundenbestellung SET status = '1' WHERE status = '0';";          //setzen auf Status = 1 -> bestellt
	$result = mysqli_query($db, $sql);		
}



?>
