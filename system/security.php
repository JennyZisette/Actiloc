<?php
  require_once("data.php");

  //Leerzeichne werden entfernt - trim
  //SQL Befehle können so nichts verändern - real escape string

	function filter_data($input){
		$db = get_db_connection();

		$input = strip_tags($input);

		$input = trim($input);

		$input = mysqli_real_escape_string($db, $input);
		mysqli_close($db);
		return $input;
	}
	?>
