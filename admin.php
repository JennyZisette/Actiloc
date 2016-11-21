<?php
require_once("system/data.php");
require_once("system/security.php");

$ort = "ort";
$restaurant_list = get_admin_restaurant();
$aktivitaet_list = get_admin_aktivitaet();




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


<h3> Restaurants </h3>
<?php
while($restaurant = mysqli_fetch_assoc($restaurant_list)) {

   ?>

  <div class="row"><!-- Beitrag-->
      <div class="col-xs-10">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><?php echo $restaurant['name']; ?></h3>
          </div>
          <div class="panel-body">
            <?php
              foreach($restaurant as $fieldname => $value) {
                echo $fieldname . ": " . $value . '<br>';
              }
            ?>
        </div>
      </div>
  </div> <!-- /Beitrag -->
</div>
<?php   } ?>
<h3> Aktivitäten </h3>
<?php
while($aktivitaet = mysqli_fetch_assoc($aktivitaet_list)) {

   ?>

  <div class="row"><!-- Beitrag-->
      <div class="col-xs-10">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><?php echo $aktivitaet['name']; ?></h3>
          </div>
                    <div class="panel-body">
            <?php
              foreach($aktivitaet as $fieldname => $value) {
                echo $fieldname . ": " . $value . '<br>';
              }
            ?>
        </div>
      </div>
  </div> <!-- /Beitrag -->
</div>
<?php } ?>


   </body>
