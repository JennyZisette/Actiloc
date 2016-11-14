<?php
  session_start();
	if(!isset($_SESSION['userid'])){
		header("Location:index.php");
	}else{
  	$user_id = $_SESSION['userid'];
	}

	require_once("system/data.php");
	require_once("system/security.php");


  if(isset($_POST['update-submit'])){
    $email = filter_data($_POST['email']);
    $password = filter_data($_POST['password']);
    $confirm_password = filter_data($_POST['confirm-password']);
    $gender = filter_data($_POST['gender']);
    $firstname = filter_data($_POST['firstname']);
    $lastname = filter_data($_POST['lastname']);
    $image_name = "";


    // Bildupload

		/*
    if ( ($_FILES['profil_img']['name']  != "")){
  		require_once('system/upload.php');
  		$image_name = upload_image($_FILES['profil_img'], "user_img/");
      if ($image == "default")
      {
        $result = get_user($user_id);
        $user = mysqli_fetch_assoc($result);
        $image_name = $user['img_src'];    // bisheriger gespeicherter Dateiname
      }
    }
    */
    $uploadOk = true;
		$upload_path = "user_img/";   // Zielverzeichnis für hochzuladene Datei
    $max_file_size = 500000;      // max. Dateigrösse in Byte

    $result = get_user($user_id);
    $user = mysqli_fetch_assoc($result);
    $image_name = $user['img_src'];    // bisheriger gespeicherter Dateiname

    // Filetype kontrollieren
		if ( ($_FILES['profil_img']['name']  != "")){
			$filetype = $_FILES['profil_img']['type'];
			switch($filetype){
				case "image/jpeg":
					$file_extension = "jpg";
					break;
				case "image/gif":
					$file_extension = "gif";
					break;
				case "image/png":
					$file_extension = "png";
					break;
				default:
				  $uploadOk = false;
			}

			// Dateigrösse kontrollieren
			$upload_filesize = $_FILES["profil_img"]["size"];
      if ( $upload_filesize >= $max_file_size) {
        echo "Leider ist die Datei mit $upload_filesize KB zu gross. <br> Sie darf nicht grösser als $max_file_size sein. ";
        $uploadOk = false;
      }

      if (!$uploadOk) {
        echo "Leider konnte die Datei nicht hochgeladen werden.";
      } else {
        $image_name = $lastname."_".$firstname . time() . "." . $file_extension;
        move_uploaded_file ($_FILES['profil_img']['tmp_name'], $upload_path . $image_name );
		  }
		}


    $result = update_user($user_id, $email, $password, $confirm_password, $gender, $firstname, $lastname, $image_name);
  }

	// Abfrage der Userdaten
  $result = get_user($user_id);
  $user = mysqli_fetch_assoc($result);

  // print_r(date_parse($user['update_time']));
  // DB-Eintrag in $update_time speichern
  // $update_time ist ein Array
  $update_time = date_parse($user['update_time']);

  // Arrays können nicht mit echo ausgegeben werden.
  // Daher Extrahierung der einzelnen Array-Werte in eine Zeichenkettenvariable $last_update
  $last_update = $update_time['day'] . "." . $update_time['month'] . "." . $update_time['year'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>p42 - Profil</title>

  <!-- Bootstrap -->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


</head>
<body>
  <nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">p42</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="home.php">Home</a></li>
          <li class="active"><a href="#">Profil</a></li>
          <li><a href="friends.php">Freunde finden</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index.php">Logout</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

  <div class="container">

    <!-- Button trigger modal -->


    <div class="panel panel-default container-fluid"> <!-- fluid -->
      <div class="panel-heading row">
        <div class="col-sm-6">
            <h4>Persönliche Einstellungen</h4>
          </div>
          <div class="col-xs-6 text-right">
            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#myModal">Profil anpassen</button>
          </div>
      </div>
      <div class="panel-body">
        <div class="col-sm-3">
          <!-- Profilbild -->
          <img src="user_img/<?php echo $user['img_src'];?>" alt="Profilbild" class="img-responsive">
          <!-- /Profilbild -->
        </div>
        <div class="col-sm-9">
          <!-- Profildaten des Users -->
          <dl class="dl-horizontal lead">
            <dt>Name</dt>
            <dd><?php echo $user['firstname'] . " " . $user['lastname'];?></dd>

            <!--<dt>Nutzername</dt>
            <dd>wobo</dd>-->

            <dt>E-Mail</dt>
            <dd><?php echo $user['email'];?></dd>

            <dt>letzte Änderung</dt>
            <dd>Ihr Profil wurde zuletzt am <?php echo $last_update?> aktualisiert.</dd>
          </dl>
          <!-- / Profildaten des Users -->
        </div>
      </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form enctype="multipart/form-data" action="<?PHP echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">persönliche Einstellungen</h4>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="Gender" class="col-sm-2 form-control-label">Anrede</label>
            <div class="col-sm-5">
              <select class="form-control form-control-sm" id="Gender" name="gender">
                <option <?php if($user['gender']=="") echo "selected"; ?> value="">--</option>
                <option <?php if($user['gender']=="Frau") echo "selected"; ?> value="Frau">Frau</option>
                <option <?php if($user['gender']=="Herr") echo "selected"; ?> value="Herr">Herr</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="Vorname" class="col-sm-2 col-xs-12 form-control-label">Name</label>
            <div class="col-sm-5 col-xs-6">
              <input  type="text" class="form-control form-control-sm"
                      id="Vorname" placeholder="Vorname"
                      name="firstname" value="<?php echo $user['firstname']; ?>">
            </div>
            <div class="col-sm-5 col-xs-6">
              <input  type="text" class="form-control form-control-sm"
                      id="Nachname" placeholder="Nachname"
                      name="lastname" value="<?php echo $user['lastname']; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="Email" class="col-sm-2 form-control-label">E-Mail</label>
            <div class="col-sm-10">
              <input  type="email" class="form-control form-control-sm"
                      id="Email" placeholder="E-Mail"
                      name="email" value="<?php echo $user['email']; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="Passwort" class="col-sm-2 form-control-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control form-control-sm" id="Passwort" placeholder="Passwort" name="password">
            </div>
          </div>
          <div class="form-group row">
            <label for="Passwort_Conf" class="col-sm-2 form-control-label">Passwort bestätigen</label>
            <div class="col-sm-10">
              <input type="password" class="form-control form-control-sm" id="Passwort_Conf" placeholder="Passwort" name="confirm-password">
            </div>
          </div>

          <div class="form-group row">
            <!-- http://plugins.krajee.com/file-input -->
            <label for="Tel" class="col-sm-2 form-control-label">Profilbild</label>
            <div class="col-sm-10">
              <input type="file" name="profil_img">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Abbrechen</button>
          <button type="submit" class="btn btn-success btn-sm" name="update-submit">Änderungen speichern</button>
        </div>
      </form>

    </div>
  </div>
</div>



  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
