<?php
  session_start();
	if(isset($_SESSION['id'])) unset($_SESSION['id']);
	session_destroy();


	// Funktionen werden über data.php ausgeführt und verbindet mit DB
	// security.php Sicherheitsfunktionen
	require_once("system/data.php");
	require_once("system/security.php");


  $error = false;
  $error_msg = "";
  $success = false;
  $success_msg = "";
  // Kontrolle, ob die Seite direkt aufgerufen wurde oder vom Login-Formular
  if(isset($_POST['login-submit'])){
    if(!empty($_POST['email']) && !empty($_POST['password'])){

      // prüft echte Eingaben
      $email = filter_data($_POST['email']);
      $password = filter_data($_POST['password']);


      $result = login($email,$password);

      // Anzahl der gefundenen Ergebnisse in $row_count
  		$row_count = mysqli_num_rows($result);
      if( $row_count == 1){
        session_start();
        $user = mysqli_fetch_assoc($result);
        $_SESSION['adminid'] = $user['admin_id'];
        header("Location:admin.php");
      }else{
        // Fehlermeldungen werden erst später angezeigt
        $error = true;
        $error_msg .= "Leider wurde wir Ihre E-Mailadresse oder Ihr Passwort nicht gefunden.</br>";
      }
    }else{
      $error = true;
      $error_msg .= "Bitte füllen Sie beide Felder aus.</br>";
    }
  }

?>

<html>
  <head>
    <meta charset="UTF-8">
    <title>ActiLoc</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/actiloc.css" rel="stylesheet" type="text/css">

    <!-- jQuery code-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>


  </head>
  <body>
      <div class="page-header col-xs-12 header">
          <header>
            <a href="index.php">
            <h1>ActiLoc </h1>
            </a>
          </header>
      </div>
      <div class="col-xs-6">
        <form id="login-form" action="login.php" method="post" role="form" style="display: block;">
          <div class="form-group">
            <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="E-Mail-Adresse" value="">
          </div>
          <div class="form-group">
            <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Passwort">
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-12">
                <button type="submit" name="login-submit" id="login-submit" tabindex="3" class="form-control btn btn-login einloggen">Einloggen</button>
              </div>
            </div>
          </div>
        </form>
        <div class="alert alert-danger" role="alert"> <?php echo $error_msg?></div>
   </body>
