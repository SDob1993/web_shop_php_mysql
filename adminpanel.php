<!DOCTYPE html>
<?php require __DIR__."/resources/php/db_connection/connection.inc.php";    //db connection
require __DIR__."/resources/php/adminok.php";     //Prüft mit Hilfe der Session Variablen ob eingeloggter User Admin ist, also Berechtigung hat diese Seite zu sehen
session_start();
?>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/styles.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <title>E-Shop Admin</title>
  </head>
  <body>
    <header>
        <ul class="right personal-menu">
            <li class="shopping-bag"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
        </ul>
        <h1 class="title">Admin</h1>
    </header>
    <div class="decal"></div>
    <div class="row">
    <div class="kunden-bestellungen col s12">
          <div class="kunden-bestellungen-title col s12" name="showed-kbestellungen"><i class="fa fa-table" aria-hidden="true"></i> Kundenbestellungen
          </div>
          <form action=<?php echo $_SERVER['PHP_SELF']; ?> method='POST'>   <!--Anzeige der in der DB gespeicherten Kundenbestellungen-->
          <div class="kunden-bestellungen-title col s12 " border=1>
             <div class="col-title col s2">Auftrag</div>
              <div class="col-title col s2">User</div>
              <div class="col-title col s2">Datum</div>             
              <div class="col-title col s2">Status</div>
              <div class="col-title col s2">Lieferstatus</div>
              <div class="col-title col s2">Action</div>
          </div>
           <?php include __DIR__."/resources/php/kbestellung_page_load.php"; ?>
          </form>       
        </div>
        <div class="col s12">
			<center>
				<a href="neuerlieferant.php"><font size="6">neuer Lieferant</font></a><br>  <!--Weiterleitung zum Anlegen neuer Produkte/Lieferanten-->
				<a href="neuesprodukt.php"><font size="6">neues Produkt</font></a><br>
				<a href="shop.php"><font size="6">zurück</font></a><br>
			</center>
		</div>        
      </div>
  </body>
</html>
