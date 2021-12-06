<?php
include_once 'conexao.php';
session_start();
ob_start();

?>
<?php
    
    $id = filter_input(INPUT_GET,"id",FILTER_SANITIZE_NUMBER_INT); // uma variavel vai receber o id

    var_dump($id);

    if(empty($id)){// verifica se a variavel esta vazia.
        $_SESSION['msg']="<p style='color: red'>Erro: usuário nao encontrado!!</p>";
        header("Location: index.php");
        exit();
    }
    ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Visualizar</title>
</head>

<body>
    <a href="index.php">Listar</a>
    <a href="cadastrar.php">Cadastrar</a>
    
   <?php
   $query_usuario="SELECT * FROM crudphp.tb_cliente WHERE ID = $id LIMIT 1";
   $result_usuario = $conexao->prepare($query_usuario);
   $result_usuario->execute();
   if(($result_usuario)AND($result_usuario->rowCount()!=0)){
       $row_usuario =$result_usuario->fetch(PDO::FETCH_ASSOC);
      // var_dump($row_usuario);
      extract($row_usuario);
            echo "ID: $id<br>";
            echo "Nome: $nome<br>";
            echo "Email: $email<br>";


   }else{
       $_SESSION['msg']="<p style='color:red'>Erro: Usuáio não encontrado:</p>";
       header("location:index.php");
   }

   ?>

</body>
</html>