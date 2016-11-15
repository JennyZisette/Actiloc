<<?php
// Verbindung mit der Datenbank
function get_db_connection()
{
  $db = mysqli_connect('localhost', '155425_3_1', 'U8vkYLSidVbD', '155425_3_1')
    or die('Verbindung zum Datenbank-Server konnte nicht aufgebaut werden.');
    mysqli_query($db, "SET NAMES 'utf8'");
  return $db;
}

//SQL Funktionen werden somit ausgeführt:

function get_result($sql)
{
  $db = get_db_connection();
  // echo $sql ."<br>";
  $result = mysqli_query($db, $sql);
  mysqli_close($db);
  return $result;
}


//Einlogen
function login($email , $password){
  $sql = "SELECT * FROM admin WHERE email = '".$email."' AND passwort = '".$password."';";
  return get_result($sql);
}


 ?>
