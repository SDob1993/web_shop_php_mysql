<!DOCTYPE html>
<?php require __DIR__."//resources/php/db_connection/connection.inc.php";
$vorname = $_POST['vorname'];       //setzen der Variablen
$name = $_POST['name'];
$adresse = $_POST['adresse'];
$plz = $_POST['plz'];
$wohnort = $_POST['wohnort'];
$telefon = $_POST['telefon'];
$email = $_POST['email'];
$password = $_POST['password'];
$allcorrect = true;
$fehlermeldung = 0;                 //Var für Fehlermeldung
$pos = strpos($email, '@');         //checks auf e-Mail
$pos1 = strpos($email, '.');
$password_md5= md5($password);      //md5- password hash
$regexchar = "/[a-zA-Z]{2,50}/";    //versch. RegEx zum checken
$regexplz = "/[0-9]{5,6}/";
$regextel = "/^(\+[0-9]{2,3})[\d\s\/\(\)-]/";
$checkname = preg_match($regexchar,$name);      //pattern checks
$checkvname = preg_match($regexchar,$vorname);
$checkplz = preg_match($regexplz,$plz);
$checktel = preg_match($regextel,$telefon);
$subjectmail ="Vielen Dank für ihre Registrierung"; //Vars für Mail
$messagemail="Viel Spaß beim shoppen!";
?>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/styles.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <title>E-Shop Register</title>
  </head>
  <body class="row">
    <header class="col s12">
        <ul class="right personal-menu">
            <li class="shopping-bag"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
        </ul>
        <h1 class="title">Register</h1>
    </header>
    <div class="decal col s12"></div>
		<div class="row">
      <div class="login-box col s4   offset-s4">
          <div class="register-fields">
			  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
              <input class="login-field" name="name" placeholder="Nachname" value="<?php echo $name; ?>"
              <?php if($name==""||($checkname==0)){ $allcorrect = FALSE; $fehlermeldung = 1;}?>/>           <!--immer check ob Field != leer und auf Pattern-->
              <input class="vorname" name="vorname" placeholder="Vorname" value="<?php echo $vorname; ?>"       
              <?php if($vorname==""||($checkvname==0)){ $allcorrect = FALSE; $fehlermeldung = 2;}?>/>      <!--setzen der entsprechenden Fehlermeldung-->
              <input class="adresse" name="adresse" placeholder="Adresse"value="<?php echo $adresse; ?>"
              <?php if($adresse==""){ $allcorrect = FALSE; $fehlermeldung = 3;}?>/>      
              <input class="plz" name="plz" placeholder="PLZ" value="<?php echo $plz; ?>"
              <?php if($plz==""||($checkplz==0)){ $allcorrect = FALSE; $fehlermeldung = 4;}?>/>      
              <input class="wohnort" name="wohnort" placeholder="Wohnort" value="<?php echo $wohnort; ?>"
              <?php if($wohnort==""){ $allcorrect = FALSE; $fehlermeldung = 5;}?>/>      
              <input class="telefon" name="telefon" placeholder="Telefon" value="<?php echo $telefon; ?>"
              <?php if($telefon==""||($checktel==0)){ $allcorrect = FALSE; $fehlermeldung = 6;}?>/>      
              <input class="email" name="email" placeholder="E-mail" value="<?php echo $email; ?>"
              <?php if($email==""|| ($pos==0) || ($pos1==0)){ $allcorrect = FALSE; $fehlermeldung = 7;}?>/>      
              <input class="passwort" name="password" placeholder="Passwort" type="password" <?php if($password==""){ $allcorrect = FALSE; $fehlermeldung = 8;}?>/>      
              
          </div>
          <div class="login-buttons col s3 offset-s4">
              <input class="login-button" type="submit" value="Register"/>
          </div>
      </div>
      </form>
      <div class="col s4 offset-s4">
      <?php if ($allcorrect){
		  $emailneu=preg_replace("/[\/\"'&%#\$]/", "", $email); //Entfernen von special chars um Injections zu verhindern
          $adresseneu=preg_replace("/[\/\"'&%#\$]/", "", $adresse);
          $telneu = preg_replace("/[\/\"'&%#\$]/", "", $telefon);
		  
		  $result = mysqli_query($db, "INSERT INTO DDSuser (name, vorname, adresse, plz, wohnort, telefon, email, password)   
		  VALUES ('$name', '$vorname' , '$adresseneu' , '$plz', '$wohnort', '$telneu', '$emailneu', '$password_md5');"); //Insert von neuem User
			if (mysqli_affected_rows($db) == -1) {                              //check auf vorhandenen Usernamen ausgabe der entsprechenden Fehlermeldung via Alert
				?> <script>alert('E-mail wird bereits verwendet')</script>
				<?php
			}
			if (mysqli_affected_rows($db) == 1) {
				?> <script>alert('User wurde erstellt!')</script>
				<?php
			}
			if (mysqli_affected_rows($db) == 0) {
				?> <script>alert('Es wurde kein User erstellt')</script>
				<?php
			}
			}
			else{ switch($fehlermeldung){ //switch für Fehlermeldung 
				  case 1: echo " <center><b>Bitte Name eingeben !</b></center>";
							break;
				  case 2: echo "<center><b> Bitte Vorame eingeben !</b></center>";
							break;
				  case 3: echo "<center><b> Bitte Adresse eingeben !</b></center>";
							break;
				  case 4: echo " <center><b>Bitte PLZ eingeben !</b></center>";
							break;
				  case 5: echo "<center><b> Bitte Wohnort eingeben !</b></center>";
							break;
				  case 6: echo " <center><b>Bitte gültige Telefonnummer eingeben !</b></center>";
							break;
				  case 7: echo " <center><b>Bitte gültige E-Mail eingeben !</b></center>";
							break;
				  case 8: echo "<center><b> Bitte Passwort eingeben !</b></center>";
							break;
					}
					} ?>
	</div></div>
    <footer>
        <p>Projektgruppe: Simon D. und Jan Durry</p>
        <p>Github-Link zum Projektverlauf: <a href="https://github.com/JanDurry/E-Shop-mit-PHP-MySQL">Datenbanken und das Internet</a></p>
        <p>
    </footer>
  </body>
</html>
