<?php
include "mysql_connect.inc";
function saveUser($user) {
  $db_query = "INSERT INTO Users VALUES (
    '',
    '".$user["name"]."',
    '".$user["email"]."',
    '".$user["phone"]."',
    '".$user["cep"]."',
    '".$user["address"]."'
  );";

  if(mysql_query($db_query) == true)
    return mysql_insert_id();
  else
    return false;
}

function saveOrder($order) {
  $db_query = "INSERT INTO Orders VALUES (
    '',
    '".$order["buyer"]."',
    '".$order["n_kits"]."',
    '".$order["al_plates"]."',
    '".$order["info"]."',
    '".$order["date"]."'
  );";

  return mysql_query($db_query);
}

function saveData($data) {
  $user = array();
  $user["name"] = $data["name"];
  $user["email"] = $data["email"];
  $user["phone"] = $data["phone"];
  $user["cep"] = $data["cep"];
  $user["address"] = $data["address"];

  $order["n_kits"] = $data["n_kits"];
  $order["al_plates"] = $data["al_plates"];
  $order["info"] = $data["info"];
  $order["date"] = date("Y-m-d");

  $res = saveUser($user);

  if ($res > 0) {
    $order["buyer"] = $res;
    $res = saveOrder($order);
  }

  mysql_close();
  return $res;
}
?>
