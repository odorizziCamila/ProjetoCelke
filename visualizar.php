<?php
include_once 'conexao.php';

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>VIsualizar</title>
</head>

<body>
    <a href="index.php">Listar</a>
    <a href="cadastrar.php">Cadastrar</a>
    <h1></h1>
    <?php
    //receber o numero da página em que o usuáio se encontra.
    $pagina_atual=filter_input(INPUT_GET,"page", FILTER_SANITIZE_NUMBER_INT);
    //metodo,page nome da vaiavel, filtro sempre por um numero inteiro
    $pagina=(!empty($pagina_atual))?$pagina_atual:1;
    var_dump($pagina);
    //setar a quanntidade de registro por pagina
    $limite_resultado =5;
    //calcular o inicio da visualização
    $inicio =($limite_resultado * $pagina)-$limite_resultado;

    $query_usuario ="SELECT * FROM crudphp.tb_cliente LIMIT $inicio,$limite_resultado";
    $result_usuario = $conexao->prepare($query_usuario);
    $result_usuario ->execute();

    if(($result_usuario) AND ($result_usuario->rowCount() !=0)){
        while($row_usuario =$result_usuario->fetch(PDO::FETCH_ASSOC)){
            //var_dump($row_usuario);
            echo"<BR>";
            extract($row_usuario);
            echo "ID: $id<br>";
            echo "Nome: $nome<br>";
            echo "Email: $email<br>";
            echo "<a href='visualizar.php'>Visualizar</a><br>";
            echo "<hr>";
        }
        //contar a quantidade de registros no banco 
        $query_qnt_registros ="SELECT COUNT(id) AS num_result FROM crudphp.tb_cliente";
        $result_qnt_registros=$conexao->prepare($query_qnt_registros);
        $result_qnt_registros->execute();
        $row_qnt_registros = $result_qnt_registros->fetch(PDO::FETCH_ASSOC);

        //Quantidade de pagina
        $qnt_pagina =ceil($row_qnt_registros['num_result']/$limite_resultado);//utilizo a função para arredondar um float 
        $maximo_link=2;//maximo de links que deve  conter
        echo"<a href='index.php?page=1'>Primeira</a>";
        for($pagina_anterior=$pagina-$maximo_link; $pagina_anterior<+$pagina-1; $pagina_anterior++){
            echo"<a href='index.php?page=$pagina_anterior'>$pagina_anterior</a>";
        }
        echo"<a href='#'>$pagina</a>";//
        echo"<a href='index.php?page=$qnt_pagina'>Ultima</a>";

    }else{
        echo"<p style='color:red;'> Erro ao efetuar o cadastro</p>";
    }
    
    ?>
    

    
</body>
</html>