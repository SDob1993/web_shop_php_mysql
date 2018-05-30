<!DOCTYPE html>
<?php require __DIR__."/resources/php/db_connection/connection.inc.php";
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
    <title>E-Shop Login</title>
  </head>
  <body class="row">
    <header class="col s12">
        <ul class="right personal-menu">
            <li class="shopping-bag"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
        </ul>
        <h1 class="title">Login</h1>
    </header>
    <div class="decal col s12"></div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="col s12"method="POST">
      <div class="login-box col s4 offset-s4">
          <div class="login-fields">
              <input type="email" class="login-field" name="user-email" placeholder="email"/>
              <input type="password" class="login-field" placeholder="passwort" name="user-pw"/>      
          </div>
          <div class="login-buttons col s3 offset-s4">
              <input class="login-button" type="submit" name="login" value="login"/>    <!--user hat Möglichkeit sich einzuloggen oder sich zu registrieren-->
              <a href="register.php">sign up</a>
          </div>
      </div>
		<div class="col s4 offset-s4">
			<?php include __DIR__."/resources/php/login.php"; ?>                     <!--Aufruf der ausgelagerten Login.php-->
		</div>
      </form>
  </body>
</html>
