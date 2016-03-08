<?php
/* Conecta ao banco de dados */
include "helper.php";
include "mysql.php";
include "mailer.php";

$errmsg = null;

/* Recebe e valida valores do formulário */
if(!isset($_POST['name']) OR
  !isset($_POST['phone']) OR
  !isset($_POST['address']) OR
  !isset($_POST['info']))
{
  $errmsg = "Por favor, preencha os campos obrigatorios.";
}

if(!isset($_POST['email']) OR
  !preg_match("/([A-Za-z0-9._%-])+@+([A-Za-z0-9._%-])+\.+([A-Za-z]){2,4}/",
    $_POST['email']))
{
  $errmsg = "Email invalido";
}

if(!isset($_POST['n_kits']) OR ($_POST['n_kits'] <= 0)) {
  $errmsg = "A quantidade de kits deve ser maior que zero.";
}

if(!isset($_POST['cep']) OR
  !preg_match("/([0-9]{5})+-+([0-9]{3})/", $_POST['cep']))
{
  $errmsg = "CEP invalido";
}

if($errmsg != null) {
  header("Location: http://faixaourokit.com.br/index.php?msg=".$errmsg);
  die();
}

$data = array();
$data["name"] = $_POST['name'];
$data["email"] = $_POST['email'];
$data["phone"] = $_POST['phone'];
$data["cep"] = $_POST['cep'];
$data["address"] = $_POST['address'];
$data["n_kits"] = $_POST['n_kits'];
$data["al_plates"] = $_POST['al_plates'];
$data["info"] = $_POST['info'];

/* Grava no banco de dados */
if(saveData($data) == false) {
  $finalmsg = "Erro no banco de dados. Por favor, entre em contato
    pelo email suporte@faixaourokit.com.br";
} else {
  /* Envia a mensagem por email */
  if(sendMsg($data) == false) {
    $finalmsg = "Erro no envio da mensagem. Por favor, entre em contato
      pelo email suporte@faixaourokit.com.br";
  } else {
    $finalmsg = "Formulario enviado com sucesso! Entraremos e contato.";
  }
}

header("Location: http://faixaourokit.com.br?msg=".$finalmsg);
exit();
?>
