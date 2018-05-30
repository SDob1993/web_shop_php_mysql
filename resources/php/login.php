<?php 
require __DIR__."/db_connection/connection.inc.php";

$login = $_POST['login'];
$mail = $_POST['user-email'];
$pw = $_POST['user-pw'];
$dbLogin = $db;

if (isset($login)) {                                            //check ob username und password nicht leer
	if ((empty($mail) == FALSE) && (empty($pw) == FALSE)) {
		login($dbLogin, $mail, $pw);
	}
	elseif ((empty($mail) == TRUE) || (empty($pw) == TRUE)) {
		wrongInput();
	}
	
}

function login($db, $mail, $pw) {
	$result = mysqli_query($db, "SELECT * FROM DDSuser;");
	while ($myrow = mysqli_fetch_array($result)) {
		if (($myrow['email'] == $mail) && ($myrow['password'] == md5($pw))) {         //check ob email passend zum user
			$usermail = $myrow['email'];
			$username = $myrow['name'];
			$userid = $myrow['userid'];
			$userlastname = $myrow['vorname'];
			forward($usermail, $username, $userid, $userlastname);
			exit;
		} else {
			continue;
		}
	}
	?> 
	<script>alert('User nicht gefunden!');</script>            <!-- wenn user nicht int db -->
	<?php
}

function forward($usermail, $username, $userid, $userlastname) {
	$_SESSION['name'] = $username;                                     //setzen der session var und weiterleitung zum shop
	$_SESSION['email'] = $usermail;
	$_SESSION['userid'] = $userid;
	$_SESSION['nachname'] = $userlastname;
	header('Location: shop.php');	
}

	

function wrongInput() {
	echo "Bitte E-Mail und Passwort eingeben!";
}

?>
