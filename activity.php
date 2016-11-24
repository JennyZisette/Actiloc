<?php
require_once("system/data.php");
require_once("system/security.php");

$indoor_outdoor = '';
$preis = '';
$aktivitaet_list='';

if(isset($_POST['filter_aktivitaet'])){
  $indoor_outdoor = $_POST['indoor_outdoor'];
  $preis = $_POST['preis'];
}

if(!empty($_GET['ort'])){
  $ort = $_GET ['ort'];
  $aktivitaet_list = get_aktivitaet($ort, $indoor_outdoor, $preis);
}
else{
  echo "Dieses Ortsfeld exisitiert nicht.";
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

      <div class="row"><!-- Aktivitätsfilter-->
          <div class="col-xs-8 listenelement">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Filter</h3>
              </div>
              <div class="panel-body">
                <form enctype="multipart/form-data" method="post">
                  <div class="row">
                    <div class="col-xs-4">
                      <h5>Wo möchtest du etwas tun?</h5>
                      <select name="indoor_outdoor">
                        <option value="indoor">Indoor</option>
                        <option value="outdoor">Outdoor</option>
                      </select>
                    </div>
                    <div class="col-xs-4">
                      <h5>Preiskategorie einschränken*</h5>
                      <select name="preis">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                      </select>
                    </div>
                    <div class="col-xs-4">
                    <button type="submit" name="filter_aktivitaet" class="btn btn-primary">Filtern</button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="panel-footer">
                <h6>* <br>Preiskategorie 1 = 0 - 50 Fr.<br>
                    Preiskategorie 2 = 51 - 100 Fr. <br>
                    Preiskategorie 3 = 101 - 500 Fr. </h6>
              </div>
            </div>
          </div>
        </div> <!-- /Aktivitätsfilter -->

      <?php   while($aktivitaet = mysqli_fetch_assoc($aktivitaet_list)) {  ?>

        <div class="row"><!-- Restaurant Listenelement-->
            <div class="col-xs-8 listenelement">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><?php echo $aktivitaet['name']; ?></h3>
                </div>
                <div class="panel-body">
                  <p><?php echo $aktivitaet['adresse']; ?></p>
                  <p><?php echo $aktivitaet['ort_id'] . " " . $aktivitaet['ortsname']; ?></p>
                  <p><?php echo $aktivitaet['lead'];?> </p>

                  <p class="p1" hidden="p1"><?php echo $aktivitaet ['beschreibungstext']; ?><br><br>
                      <?php echo $aktivitaet ['telefon'];?><br>
                      <?php echo $aktivitaet ['website'];?></p>
                </div>
                      <!-- Klappentext -->
                      <div class="panel-footer">
                      <script>

                      $(document).ready(function(){
                        $(".show-button").click(function(){
                            $(this).closest('.panel').find('.p1').show();
                        });
                        $(".hide-button").click(function(){
                              $(this).closest('.panel').find('.p1').hide();
                          });
                      });
                        </script>
                        <button class="show-button">Mehr anzeigen</button>
                        <button class="hide-button">Weniger anzeigen</button>
                    </div>
                    <!-- Klappentext -->




              </div>
            </div>
          </div> <!-- /Restaurant Listenelement -->
        </div>

      <?php   } ?>

  </body>
