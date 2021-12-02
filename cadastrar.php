<?php
include_once 'conexao.php';
//$buscar_cadastros = "SELECT * FROM crudphp.tb_cliente";
//$listagem =$conexao-> prepare($buscar_cadastros);
//$listagem->execute();
//$query_cadastros = mysqli_query($conexao,$buscar_cadastros );
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastrar</title>
    </head>
    <body>
        <h1>Cadastrar</h1>
        <?php
        $dados=filter_input_array(INPUT_POST,FILTER_DEFAULT);

        if(!empty($dados['cadUsuario'])){// somente se o cliente clicar sobre o botao
            //var_dump($dados);// var dump é para imprimir na tela.
            $query_usuario = "INSERT INTO crudphp.tb_cliente (nome, email) VALUES ('".$dados['nome']."','".$dados['email']."')";
            $cad_usuario = $conexao->prepare($query_usuario);
            $cad_usuario->execute();

            if($cad_usuario->rowCount()){
           
                echo "<p style='color:green;'>Usuário cadastrado com sucesso!</p>";
                echo'<br>';
            }else {
                echo"<p style='color:red;'> Erro ao efetuar o cadastro</p>";
                echo'<br>';
            }
        
        }
        
        ?>
        <form name="cad-usuario" method="POST" action="">
            <label>Nome:</label>
            <input type="text" name="nome" id="nome" placeholder="Nome Completo"/><br><br>

            <label>E-mail:</label>
            <input type="email" name="email" id="email" placeholder="Seu melhor e-mail "/><br><br>

            
            <input type="submit" value="cadastrar" name="cadUsuario"/><br><br>

        </form>

        <?php /* 
            while ($receber_cadastros = mysqli_fetch_array ($)) {
                $id = $receber_cadastros [ 'id' ];
                $nome = $receber_cadastros [ 'nome' ];
                $email = $receber_cadastros [ 'email' ];
               
              */
            ?>
            
            <tr>
                <td  scope = " row " > <?php  echo  $id ; ?> </ td >
                <td > <input  type = " text " name = " nome " value = " <?php  echo  $nome ; ?> " > </ td >
                <td > <input  type = " text " name = " email " value = " <?php  echo  $email ; ?> " > </ td >

                 
            </tr >
            <?php /* };*/ ?>

            <tr >
            <form  action = " cadastro.php " method = " post " >
            <td > <input  type = " text " name = " nome " > </ td >
            <td > <input  type = " text " name = " telefone " > </ td >
            <td > <input  type = " submit " value = " Cadastro " > </ td >
            </form >
            </tr >
       
    </body>



</html>