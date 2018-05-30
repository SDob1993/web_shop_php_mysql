<?php
require __DIR__."/db_connection/connection.inc.php";

refresh($db);

if (in_array("bezahlt",$_POST)){            // Query befehl, um den Status von Vorrätig auf bezahl bzw. nicht bezahlt zu setzen
			$key = array_search("bezahlt", $_POST);
			$result2 = mysqli_query($db, "UPDATE DDSkundenbestellung SET status=CASE WHEN status='2' THEN '1' ELSE '2' END WHERE auftragid='$key';");
			?>
			<script type="text/javascript">
			window.location.href = 'adminpanel.php';
			</script>
			<?php
			}
			
if (in_array("bestand",$_POST)){            // Query befehl, um den Status von Vorrätig auf vorrätig bzw. nicht vorrätig zu setzen
			$key2 = array_search("bestand", $_POST);
			$result3 = mysqli_query($db, "UPDATE DDSkundenbestellung SET bestandaktualisiert=CASE WHEN bestandaktualisiert='1' THEN '0' ELSE '1' END WHERE auftragid='$key2';");
			?>
			<script type="text/javascript">
			window.location.href = 'adminpanel.php';
			</script>
			<?php
			}
			
function refresh($db) {
	$result = mysqli_query($db, "SELECT * FROM DDSkundenbestellung;");
	while ($myrow = mysqli_fetch_array($result)) { 
		$statusText = "";
		$bestandText = "";
		if($myrow['status']==0){ // Zeigt nur Bestellungen an die tatsächlich bestellt worden( status 1) sind
			continue;
		}
		if ($myrow['status']==1) {    //statustext direkt abhängig von status
			$statusText = "übermittelt";
			
		}
		if ($myrow['status']==2) {
			$statusText = "bezahlt";
		}
		if($myrow['bestandaktualisiert']==0){
			$bestandText = "nicht vorrätig";
		}
		if($myrow['bestandaktualisiert']==1){
			$bestandText = "vörratig";
		}	
			?>
		<form action=<?php echo $_SERVER['PHP_SELF']; ?> method='POST'>
		<div class='kunden-bestellung col s12 ' name='product-table' border=1>
		<div name='auftragid' class='bcol col s2'><?php echo $myrow['auftragid']; ?></div>
		<div name='userid' class='bcol col s2'><?php echo $myrow['userid']; ?></div>
		<div name='date' class='bcol col s2'><?php echo $myrow['auftragsdatum']; ?></div>
		<div name='status' class='bcol col s2'><?php echo $statusText; ?></div>
		<div name='bestandakt' class='bcol col s2'><?php echo $bestandText; ?> </div>
		<div class='product-item col s2'><input type='submit' class='bezahlt-submit' name="<?php echo $myrow['auftragid'] ?>" value="bezahlt"/><input type='submit' class='bezahlt-submit' name="<?php echo $myrow['auftragid'] ?>" value='bestand'/></div>
		
		</div>
		
		</form>
		<?php
}
}
			
?>
