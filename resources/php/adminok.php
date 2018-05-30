<!DOCTYPE html>
<?php require __DIR__."/db_connection/connection.inc.php";
session_start();                    //holt sich anhand der email den adminstatus des Users, wenn 0 -> Fehlermeldung
$email=$_SESSION['email'];
$result = mysqli_query($db, "SELECT admin FROM DDSuser WHERE email='$email';");
$myrow = mysqli_fetch_array($result);
if($myrow['admin']==0){ echo "<h1>KEINE BERECHTIGUNG</h1>"; exit();}
?>
