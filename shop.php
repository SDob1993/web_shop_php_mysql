<!DOCTYPE html>
<?php require __DIR__."/resources/php/db_connection/connection.inc.php";
session_start();
$adminstatus = $_SESSION['email'];      //e-mail == username -> Verwendung zum admin check
$username = $_SESSION['name'];
$userlastname = $_SESSION['nachname'];
?>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/styles.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <title>E-Shop</title>
  </head>
  <body class="row">
    <header class="col s12">
        <ul class="right personal-menu">
            <li class="shopping-bag"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
        </ul>
        <div class="title">Willkommen, <?php echo "".$username." ".$userlastname."";?></div> <!-- Begrüßung-->
    </header>
    <div class="decal col s12"></div>
    <content class="col s12">
        <div class="col s2 left search-content">
            <h2 class="search-title"><i class="fa fa-search" aria-hidden="true"></i> Selektieren</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="text" name="search-product" class="search-product-input" />
            </form>
        </div>
        <div class="col s8 product-content">
            <div class="row">
                <div class="products-title" name="showed-products"><i class="fa fa-table" aria-hidden="true"></i> Artikel
                </div>
                <div class="product-table-title row" border=1>                  <!--Anzeigen der Produkte aus der DB-->
                    <div class="product-item-title col s2">Artikelnr</div>
                    <div class="product-item-title col s2">Name</div>
                    <div class="product-item-title col s2">Beschreibung</div>
                    <div class="product-item-title col s2">Bild</div>
                    <div class="product-item-title col s1">Preis</div>
                    <div class="product-item-title col s1">Anzahl</div>
                    <div class="product-item-title col s2"></div>
                </div>
                <?php include __DIR__."/resources/php/articles_page_load.php"; ?>
            </div>
        </div>
        <div class="col s2 right product-shopping-cart" name="shopping-cart">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="row">
            <h2 class="cart-title col s12"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Warenkorb</h2>
            <ul class="cart-list col s12">
			<?php include __DIR__."/resources/php/add_to_cart.php"; ?>
            </ul>
            <input type="submit" name="order-submit" class="cart-submit-button" value="Bestellen">
            <?php include __DIR__."/resources/php/submit_order.php"; ?>
            </div>
            </form>
        </div>
        	<center>
				<a href="shop.php"><font size="4"><?php include __DIR__."/resources/php/admin_area.php"; ?></font></a> <!--Anzeige der AdminArea abhängig vom adminstatus-->
			</center>
    </content>
  </body>
</html>
