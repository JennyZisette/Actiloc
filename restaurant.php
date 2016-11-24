<?php
require_once("system/data.php");
require_once("system/security.php");

if(!empty($_GET['ort'])){
  $ort = $_GET ['ort'];
  $restaurant_list = get_restaurant($ort);
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
      <?php   while($restaurant = mysqli_fetch_assoc($restaurant_list)) {  ?>

        <div class="row"><!-- Restaurant Listenelement-->
            <div class="col-xs-8 listenelement">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><?php echo $restaurant['name']; ?></h3>
                </div>
                <div class="panel-body">
                  <p><?php echo $restaurant['adresse']; ?></p>
                  <p><?php echo $restaurant['ort_id'] . " " . $restaurant['ortsname']; ?></p>
                  <p><?php echo $restaurant['lead'];?> </p>

                  <p class="p1" hidden="p1"><?php echo $restaurant ['beschreibungstext']; ?><br><br>
                      <?php echo $restaurant ['telefon'];?><br>
                      <?php echo $restaurant ['website'];?></p>

                  <div class="panel-footer">  <!-- Klappentext -->
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
              <button class="show-button">mehr anzeigen</button>
              <button class="hide-button">weniger anzeigen</button>

              </div>
            </div>
          </div>
      </div> <!-- /Restaurant Listenelement -->
    </div>

      <!-- Klappentext -->


      <?php   } ?>

   </body>
