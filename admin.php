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

  <!-- Post hinzufügen -->
  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-default">
        <div class="panel-heading">Restaurant hinzufügen?</div>
        <div class="panel-body">
          <form enctype="multipart/form-data" method="post" action="<?PHP echo $_SERVER['PHP_SELF'] ?>">

            <fieldset class="form-group">
              <p>name</p><textarea class="form-control" rows="1" name="name"></textarea>

              <p>ort_id (PLZ)</p><input type="number" class="form-control" rows="1" name="ort_id" min="1000" max="9999">

            <p>adresse</p>  <textarea class="form-control" rows="1" name="adresse"></textarea>

            <p>kueche_id</p>  <select name="kueche_id><" class="form-control" rows="3" name="kueche_id">
                <option value="italienisch">1</option>
                <option value="asiatisch">2</option>
                <option value="schweizerisch">3</option>
                </select>
            <p>preis</p>  <select name="kueche_id><" class="form-control" rows="3" name="kueche_id">
                    <option value="günstig">1</option>
                    <option value="mittel">2</option>
                    <option value="teuer">3</option>
                    </select>
            <p>beschreibungstext</p>  <textarea class="form-control" rows="1" name="adresse"></textarea>
            <p>lead</p>  <textarea class="form-control" rows="1" name="adresse"></textarea>
            <p>telefon</p>  <input type="number" class="form-control" rows="1" name="ort_id" min="1000" max="9999">
            <p>website</p>  <textarea class="form-control" rows="1" name="adresse"></textarea>
                </fieldset>
            <div class="collapse" id="upload_container">
              <div class="well">
                  </div>
                  </div>


            <button type="submit" name="post-submit" class="btn btn-primary">posten</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /Post hinzufügen -->


<?php   while($post = mysqli_fetch_assoc($restaurant_list)) { ?>
  <!-- Beitrag -->
    <div class="row">
      <div class="col-xs-2">
        <div class="thumbnail p42thumbnail">
        </div><!-- /thumbnail p42thumbnail -->
      </div><!-- /col-sm-2 -->

      <form enctype="multipart/form-data" class="form-inline" method="post" action="<?PHP echo $_SERVER['PHP_SELF'] ?>">
        <div class="col-xs-10">
          <div class="panel panel-default p42panel">
            <div class="panel-heading">
<?php if($post['owner'] == $user_id){  ?>
              <button type="submit" class="close" name="post_delete" value="<?php echo $post['post_id']; ?>">
                <span aria-hidden="true">&times;</span>
              </button>
<?php } ?>
              <h3 class="panel-title"><?php echo $post['firstname'] . " " . $post['lastname']; ?></h3>
            </div>
            <div class="panel-body">
              <p><?php echo $post['text']; ?></p>


<?php } ?>
            </div>
            <div class="panel-footer text-right">
              <small><a class="text-muted" href="#"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></a></small>
            </div>
          </div>
        </div><!-- /col-sm-10 -->
      </form>
    </div> <!-- /Beitrag -->

</div> <!-- /Hauptinhalt -->










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
 </div>
 <?php } ?>



    </body>
