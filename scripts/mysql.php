<?php
include "mysql_conect.inc";

function saveUser($user) {
  $db_query = "INSERT INTO Users VALUES (
    '',
    '".$data["name"]."',
    '".$data["email"]."',
    '".$data["phone"]."',
    '".$data["cep"]."',
    '".$data["address"]."
  );";

  if(mysql_query($db_query) == true)
    return mysql_insert_id();
  else
    return false;
}

function saveOrder($order) {
  echo "saveOrder!! "; // retirar
  $db_query = "INSERT INTO Orders VALUES (
    '',
    '".$data["buyer"]."
    '".$data["n_kits"]."',
    '".$data["al_plates"]."',
    '".$data["info"]."',
    '".$data["date"]."',
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

  $order["n_kits"] = $data["kits"];
  $order["al_plates"] = $data["al_plates"];
  $order["info"] = $data["info"];
  $order["date"] = date("Y, m, d");

  $res = saveUser($user);

  if ($res > 0) {
    $order["buyer"] = $res;
    $res = saveOrder($order);
  }

  mysql_close();
  return $res;
}
?>
