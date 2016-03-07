<?php
   $handle = mysql_connect('localhost', 'root', 'fxouro!')
   or die ("Erro, falha ao conectar com o BD, consulte o administrador.");  
   $database = mysql_select_db('fxouro')
   or die ("Erro, banco nao encontrado, consulte o administrador.");
?>
