<?php


$host = 'localhost';
$user ='root';
$pass='';
$bdname ='crudphp';


$conexao = new PDO ("mysql:host=$host;bdname=$bdname ", "$user", "$pass");

  if ($conexao) {
    echo'conectou ';
}else{
    echo 'erro';
}
?>