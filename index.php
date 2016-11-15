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

    <!-- fürs Plugin -->
    <link rel="stylesheet" href="plugin/css/ap-scroll-top.css">
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="plugin/js/ap-scroll-top.js"></script>
  </head>
  <body>
      <div class="page-header col-xs-12 header">
          <header>
            <a href="index.php">
            <h1>ActiLoc </h1>
            </a>
          </header>
      </div>
      <!-- Formular für Angebotssuche-->
      <div>
        <div class="col-xs-12">
          <h2> Wohin willst du?</h2>

          <form method="get">
            <div class="form-group">
                 <div class="form-group">
                      <label for="ort"></label>
                      <input type="text" class="form-control" id="ort" name="ort" placeholder="Wohin willst du?" maxlength="30" required="required">
                 </div>
            </div>
                 <button formaction="restaurant.php" type="submit" class="btn btn-default">Restaurant</button>
                 <button formaction="activity.php" type="submit" class="btn btn-default">Aktivitäten</button>
          </form>

        </div>
      </div>
  </body>
<html>
