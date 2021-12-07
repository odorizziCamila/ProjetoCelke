<?php
session_start();
ob_start();
include_once 'conexao.php';

$id = filter_input(INPUT_GET,"id", FILTER_SANITIZE_NUMBER_INT);
var_dump($id);

if(empty($id)){// verifica se a variavel esta vazia.
    $_SESSION['msg']="<p style='color:red'>Erro: usuário nao encontrado!!</p>";
    header("Location: index.php");
    exit();
}

$query_usuario = "SELECT * FROM crudphp.tb_cliente WHERE id = $id ";
$result_usuario=$conexao->prepare($query_usuario);
$result_usuario-> execute();

if(($result_usuario) AND ($result_usuario->rowCount()!= 0)){
    $query_del_usurio = "DELETE FROM crudphp.tb_cliente WHERE id= $id ";
    $apagar_usuario =$conexao->prepare($query_del_usurio);
   if($apagar_usuario->execute()){
    $_SESSION['msg']="<p style='color:green'>Usuario apagado com sucesso!!</p>";
    header("Location: index.php");
   }else{
    $_SESSION['msg']="<p style='color:red'>Erro: não foi possivel apagar o usuario!!</p>";
    header("Location: index.php"); 
   }
}else{
    $_SESSION['msg']="<p style='color:red'>Erro: usuário nao encontrado!!</p>";
    header("Location: index.php");
}



?>