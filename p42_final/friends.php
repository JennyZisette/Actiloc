<?php
  session_start();
	if(!isset($_SESSION['userid'])){
		header("Location:index.php");
	}else{
  	$user_id = $_SESSION['userid'];
	}
	
	require_once("system/data.php");
	require_once("system/security.php");
	
	if(isset($_POST['new_friends'])){
		add_friends($user_id, $_POST['new_friends']);
	}
	
  $no_friend_list = get_no_friend_list($user_id);


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>p42 - Freunde finden</title>

  <!-- Bootstrap -->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <link rel="stylesheet" href="css/p42_style.css">
  
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
          <li><a href="profil.php">Profil</a></li>
          <li class="active"><a href="#">Freunde finden</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index.php">Logout</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  
  <div class="container">
    
     <h3>alle p42-ler, die noch nicht meine Freunde sind</h3><hr />
     <form method="post" action="<?PHP echo $_SERVER['PHP_SELF'] ?>" >
<?php while($user = mysqli_fetch_assoc($no_friend_list)) { ?>
      <!-- Freund+ Button -->
      <div class="form-group row p42-form-group">
        <input type="checkbox" name="new_friends[]" id="userid<?php echo $user['user_id'] ?>" autocomplete="off" value="<?php echo $user['user_id'] ?>"/>
        <div class="btn-group col-xs-12">
          <label for="userid<?php echo $user['user_id'] ?>" class="btn btn-default  col-xs-2 col-sm-1">
            <span class="glyphicon glyphicon-plus"></span>
            <span> </span>
          </label>
          <label for="userid<?php echo $user['user_id'] ?>" class="btn btn-default active col-xs-10 col-sm-11">
              <?php echo $user['firstname'] . " " . $user['lastname'] ?>
          
          </label>
        </div>
      </div> 
      <!-- /Freund+ Button -->
<?php } ?>
      <input type="submit" class="btn btn-default" value="zu meinen Freunden hinzufügen" />
     </form>          
  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>