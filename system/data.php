<?php
// Verbindung mit der Datenbank
function get_db_connection()
{
  $db = mysqli_connect('localhost', '155425_3_1', 'zwDEeuSNJ4BC', '155425_3_1')
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


//Einloggen
function login($email , $password){
  $sql = "SELECT * FROM admin WHERE email = '".$email."' AND password = '".$password."';";
  return get_result($sql);
}


// Restaurant
function get_restaurant($ort){

  $sql = "SELECT kueche.art, restaurant.name, restaurant.adresse, restaurant.lead, restaurant.beschreibungstext, restaurant.website, restaurant.telefon, ort.ort_id, ort.ortsname FROM restaurant
  INNER JOIN kueche USING(kueche_id)
  INNER JOIN ort USING(ort_id)
  WHERE ort_id = '".$ort."';";
  return get_result($sql);
}

//Aktivität
function get_aktivitaet($ort){

  $sql = "SELECT aktivitaet.name, aktivitaet.adresse, aktivitaet.lead, aktivitaet.ort_id, aktivitaet.beschreibungstext, aktivitaet.telefon, aktivitaet.website, ort.ort_id, ort.ortsname FROM aktivitaet
  INNER JOIN ort USING(ort_id)
  WHERE ort_id = '".$ort."';";
  return get_result($sql);
}

// admin Restaurant Anzeige
function get_admin_restaurant($ort){

  $sql = "SELECT * FROM `restaurant`";
  return get_result($sql);
}


// admin Aktivität Anzeige
function get_admin_aktivitaet($ort){

  $sql = "SELECT * FROM `aktivitaet'";
    return get_result($sql);
}


function get_ort($ort){

  $sql = "SELECT * FROM 'ort'";
}

?>
