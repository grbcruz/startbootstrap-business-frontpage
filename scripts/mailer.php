<?php
function sendMsg($data) {
  echo "sendMsg!! "; // retirar
  /* Destinatário */
  $to = $data["email"];

  /* Assunto */
  $subject = "Requisição de orçamento de ".$data["name"];

  /* Mensagem */
  $msg ="
    <html>
      <head><title>Requisição de orçamento</title></head> 
      <body>
        <p><b>Enviar orçamento para ".$data["name"].":</b></p>
        <p>E-mail: ".$data["email"]."<br>
          Telefone: ".$data["phone"]."<br>
          Endereço: ".$data["address"].". CEP: ".$data["cep"]."</p>
        <p>Informação do pedido:</p>
        <p>Quantidade de kits: ".$data["n_kits"]."<br>
        Quantidade de pares de placas de alumínio: ".$data["al_plates"]."<br>
          Informações:<br>".$data["info"]."</p>
      </body>
    </html>
  ";

  $headers = "MIME-Version: 1.0\n";
  $headers .= "Content-type: text/html; charset=iso-8859-1\n";
  $headers .= "From: noreply@faixaourokit.com.br\n";

  $headers .= "Return-Path: suporte@faixaourokit.com.br\n";

  /* Enviando a mensagem */
  $res = mail($to, $subject, $msg, $headers);

  if($res == true) {
    phpAlert("Mensagem enviada com sucesso. Em breve entraremos 
      em contato. Obrigado!");
  }

  return $res;
}
?>
