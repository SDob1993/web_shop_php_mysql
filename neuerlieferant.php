<?php
require __DIR__."/resources/php/db_connection/connection.inc.php";
require __DIR__."/resources/php/adminok.php";
$lieferantid = $_POST['lieferantid'];
$lieferant = $_POST['lieferant'];
$adresse = $_POST['adresse'];
$plz = $_POST['plz'];
$ort = $_POST['ort'];
$telefon = $_POST['telefon'];
$email = $_POST['email'];
$allcorrect = TRUE;
$exislieferant = $_POST['exislieferant'];
//UPDATE
if(in_array("Lieferant anzeigen",$_POST)){             
	//admin lässt sich vorhandenen Lieferanten anzeigen
$getprodukt = mysqli_query($db, "SELECT * FROM DDSlieferant where lieferantid='$exislieferant';");
while ($row = mysqli_fetch_array($getprodukt)){
		$lieferantid = $row['lieferantid'];
		$lieferant = $row['lieferant'];
		$adresse = $row['adresse'];
		$plz = $row['plz'];
		$ort = $row['ort'];
		$telefon = $row['telefon'];
		$email = $row['email'];
		}
}
?>

<html>
<head>
<title>EShop Lieferantenbereich</title>
<meta charset="UTF-8">
</head>
<body>
<center>


<h1>Artikel ändern oder hinzufügen</h1>
<!--Setup Form mit ensprechenden inputs -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input name="exislieferant" type="text" size="30" maxlength="30"  placeholder="Vorhandene Lieferantenid"/>
<br>
<input type="submit" name="getlieferant" value="Lieferant anzeigen">
<table border="1" cellpadding="4">
 <tr>
  <td align="right">Lieferantid:</td>
  <td><input name="lieferantid" type="text" size="30" maxlength="30" value="<?php echo $lieferantid; ?>"/></td>
  <td><?php if($lieferantid==""){ echo "Bitte gültige ID eingeben"; $allcorrect = FALSE;}?></td>
 </tr><tr>
  <td align="right">Lieferant:</td>
  <td><input name="lieferant" type="text" size="30" maxlength="40" value="<?php echo $lieferant; ?>"/></td>
 </tr>
 <tr>
  <td align="right">Adresse:</td>
  <td><input name="adresse" type="text" size="30" maxlength="30" value="<?php echo $adresse; ?>"/></td>
  <td><?php if($adresse=="") echo "Bitte Adresse eingeben"; ?></td>
 </tr><tr>
<td align="right">PLZ:</td>
  <td><input name="plz" type="text" size="30" maxlength="30" value="<?php echo $plz; ?>"/></td>
  <td><?php if($plz=="") echo "Bitte Plz eingeben"; ?></td>
</tr>
<tr>
  <td align="right">Ort:</td>
  <td><input name="ort" type="text" size="10" maxlength="10" value="<?php echo $ort; ?>"/></td>
  <td><?php if($ort==""){ echo "Bitte ort eingeben"; $allcorrect = FALSE;}?></td>
 </tr>
 <tr><td align="right">Telefon:</td>
  <td><input name="telefon" type="text" size="30" maxlength="30" value="<?php echo $telefon; ?>"/></td>
 </tr>
<tr><td align="right">Email:</td>
  <td><input name="email" type="text" size="30" maxlength="30" value="<?php echo $email; ?>"/></td>
 </tr>
</table>
<br>
<input type="submit" name="abschicken" value="abschicken"><input type="submit" name="update" value="update"/><br>
</form>
<?php  if(($allcorrect && (in_array("abschicken",$_POST)))){
	//anlegen von neuem Lieferanten
		$result = mysqli_query($db, "INSERT INTO DDSlieferant (lieferantid,lieferant,adresse,plz,ort,telefon,email)
		 VALUES ('$lieferantid','$lieferant','$adresse','$plz','$ort','$telefon','$email');");
	
		echo "DATEN ÜBERMITTEL!";}
		elseif($allcorrect && (in_array("update",$_POST))){
		$lieferantid=$_POST['lieferantid'];
		$lieferant = $_POST['lieferant'];
		$adressse = $_POST['adresse'];
		$plz = $_POST['plz'];
		$ort = $_POST['ort'];
		$telefon = $_POST['telefon'];
		$email = $_POST['email'];
		
		//admin kann vorhandenen Lieferanten anlegen
		$result = mysqli_query($db, "UPDATE DDSlieferant SET lieferant='$lieferant', adresse='$adresse', plz='$plz', 
		ort='$ort', telefon='$telefon', email='$email'  WHERE lieferantid='$lieferantid';");
	
		echo "NEUES PRODUKT ÜBERMITTEL!";}
		
		?>

</center>
</body>
</html>
