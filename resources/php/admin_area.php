<?php

$result = mysqli_query($db, "SELECT admin FROM DDSuser where email='$adminstatus';"); //holt sich aus db anhand der email den adminstatus des Users
$myrow = mysqli_fetch_array($result);

if ($myrow['admin'] == 1) { ?>
	<p><a href="adminpanel.php">Zugang für Admins</a></p>
	<?php
}


?>
