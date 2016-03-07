<?php
/* Conecta ao banco de dados */
include "helper.php";
include "mysql.php";
include "mailer.php";

/* Recebe e valida valores do formulário */
if(!isset($_POST['name']) OR
  !isset($_POST['phone']) OR
  !isset($_POST['address']) OR
  !isset($_POST['info']))
{
  phpAlert("Por favor, preencha os campos obrigatórios.");
}

if(!isset($_POST['email']) OR
  eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", $_POST['email']))
{
  phpAlert("Email inválido");
}

if(!isset($_POST['n_kits']) OR ($_POST['n_kits'] <= 0)) {
  phpAlert("A quantidade de kits deve ser maior que zero.");
}

if(!isset($_POST['cep']) OR
  eregi("([0-9]{5})+-+([0-9]{3})", $_POST['cep']))
{
  phpAlert("CEP inválido");
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
  phpAlert("Erro no banco de dados. Por favor, entre em contato
    pelo email suporte@faixaourokit.com.br");
}

/* Envia a mensagem por email */
if(sendMessage($data) == false) {
  phpAlert("Erro no envio da mensagem. Por favor, entre em contato
    pelo email suporte@faixaourokit.com.br");
}
?>
