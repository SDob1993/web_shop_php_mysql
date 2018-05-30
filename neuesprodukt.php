<?php
require __DIR__."/resources/php/db_connection/connection.inc.php";
require __DIR__."/resources/php/adminok.php";
$produktid = $_POST['produktid'];
$name = $_POST['pname'];
$lieferantid = $_POST['lieferantid'];
$beschreibung = $_POST['beschreibung'];
$einkaufspreis = $_POST['einkaufspreis'];
$verkaufspreis = $_POST['verkaufspreis'];
$mengelager = $_POST['mengelager'];
$allcorrect = TRUE;
$exisprodukt = $_POST['exisprodukt'];
//Wenn artikel anzeigen Button gedrückt wird, wird das Produkt mit der eingegebenen ID angezeigt 
if(in_array("Artikel anzeigen",$_POST)){
$getprodukt = mysqli_query($db, "SELECT * FROM DDSprodukte where produktid='$exisprodukt';");
while ($row = mysqli_fetch_array($getprodukt)){
	$produktid = $row['produktid'];
	$name = $row['pname'];
	$lieferantid = $row['lieferantid'];
	$email = $row['email'];
	$beschreibung = $row['pbeschreibung'];
	$einkaufspreis = $row['einkaufspreis'];
	$verkaufspreis = $row['verkaufspreis'];
	$mengelager = $row['mengelager'];
	}
}
?>

<html>
<head>
<title>EShop Artikelbereich</title>
<meta charset="UTF-8">
</head>
<body>
<center>


<h1>Artikel ändern oder hinzufügen</h1>
<!--Setup der Form für entsprechende Felder -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input name="exisprodukt" type="text" size="30" maxlength="30"  placeholder="Vorhandene Artikelnummer"/>
<br>
<input type="submit" name="getartikel" value="Artikel anzeigen">
<table border="1" cellpadding="4">
 <tr>
  <td align="right">Produktid:</td>
  <td><input name="produktid" type="text" size="30" maxlength="30" value="<?php echo $produktid; ?>"/></td>
  <td><?php if($produktid==""){ echo "Bitte gültige ID eingeben"; $allcorrect = FALSE;}?></td>
 </tr><tr>
  <td align="right">Name:</td>
  <td><input name="pname" type="text" size="30" maxlength="40" value="<?php echo $name; ?>"/></td>
 </tr>
 <tr>
  <td align="right">Lieferantid:</td>
  <td><input name="lieferantid" type="text" size="30" maxlength="30" value="<?php echo $lieferantid; ?>"/></td>
  <td><?php if($lieferantid=="") echo "Bitte Lieferantid eingeben"; ?></td>
 </tr><tr>
<td align="right">Beschreibung:</td>
<td><textarea name="beschreibung" cols="50" rows="3" placeholder="Beschreibung" ><?php echo $beschreibung; ?> </textarea></td>
</tr>
<tr>
  <td align="right">Einkaufspreis:</td>
  <td><input name="einkaufspreis" type="text" size="10" maxlength="10" value="<?php echo $einkaufspreis; ?>"/></td>
  <td><?php if($einkaufspreis==""){ echo "Bitte EK eingeben"; $allcorrect = FALSE;}?></td>
 </tr>
 <tr><td align="right">Verkaufspreis:</td>
  <td><input name="verkaufspreis" type="text" size="30" maxlength="30" value="<?php echo $verkaufspreis; ?>"/></td>
 </tr>
<tr><td align="right">Mengelager:</td>
  <td><input name="mengelager" type="text" size="30" maxlength="30" value="<?php echo $mengelager; ?>"/></td>
 </tr>
</table>
<br>
<input type="submit" name="abschicken" value="abschicken"><input type="submit" name="update" value="update"/><br>
</form>
<?php  if(($allcorrect && (in_array("abschicken",$_POST)))){
		//boolean ob alle Daten korrekt und Insert into( Anlegen eines neuen Produkts)
		$result = mysqli_query($db, "INSERT INTO DDSprodukte (produktid,pname,pbeschreibung,lieferantid,einkaufspreis,verkaufspreis,mengelager)
		 VALUES ('$produktid','$name','$beschreibung','$lieferantid','$einkaufspreis','$verkaufspreis','$mengelager');");
	
		echo "DATEN ÜBERMITTEL!";}
		elseif($allcorrect && (in_array("update",$_POST))){
		//update Button gedrückt -> Admin lässt sich vorhandenes Produkt anzeigen und kann es bearbeiten
		$produktid=$_POST['produktid'];
		$name = $_POST['pname'];
		$lieferantid = $_POST['lieferantid'];
		$beschreibung = $_POST['beschreibung'];
		$einkaufspreis = $_POST['einkaufspreis'];
		$verkaufspreis = $_POST['verkaufspreis'];
		$mengelager = $_POST['menge'];
		
		
		$result = mysqli_query($db, "UPDATE DDSprodukte SET pname='$name', pbeschreibung='$beschreibung', lieferantid='$lieferantid', 
		einkaufspreis='$einkaufspreis', verkaufspreis='$verkaufspreis', mengelager='$mengelager'  WHERE produktid='$produktid';");
	
		echo "NEUES PRODUKT ÜBERMITTEL!";}
		
		?>

</center>
</body>
</html>
