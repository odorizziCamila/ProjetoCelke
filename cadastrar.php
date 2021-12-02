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
    //receber os dados do formulario
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($dados['cadUsuario'])) { // somente se o cliente clicar sobre o botao
        $empty_input = false;
        $dados = array_map('trim', $dados); // valida espaços em branco do formulario
        if (in_array("", $dados)) { // verifica espaço no campo
            $empty_input = true;
            echo "<p style='color:red;'> Necessário preencher todos os campos</p>";
            
        }elseif(!filter_var($dados['email'],FILTER_VALIDATE_EMAIL)){
            $empty_input=true;
            echo "<p style='color=red'> Preenchimento de email invalido";
        }
        //var_dump($dados);// var dump é para imprimir na tela.
        if (!$empty_input){

            $query_usuario = "INSERT INTO crudphp.tb_cliente (nome, email) VALUES (:nome, :email)";
            $cad_usuario = $conexao->prepare($query_usuario);
            $cad_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
            $cad_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
            $cad_usuario->execute();

            if ($cad_usuario->rowCount()) {

                echo "<p style='color:green;'>Usuário cadastrado com sucesso!</p>";
                echo '<br>';
                unset($dados);//destruir o que esta dentro da variavel dados
            } else {
                echo "<p style='color:red;'> Erro ao efetuar o cadastro</p>";
                echo '<br>';
            }
        }
    }


    ?>
    <form name="cad-usuario" method="POST" action="">
        <label>Nome:</label>
        <input type="text" name="nome" id="nome" placeholder="Nome Completo" value="<?php if (isset($dados['nome'])){
            echo $dados['nome'];
        }
            ?>"/><br><br>

        <label>E-mail:</label>
        <input type="email" name="email" id="email" placeholder="Seu melhor e-mail "value="<?php if (isset($dados['email'])){
            echo $dados['email'];
        }
            ?>"/><br><br>


        <input type="submit" value="cadastrar" name="cadUsuario" /><br><br>

    </form>

    <?php /* 
            while ($receber_cadastros = mysqli_fetch_array ($)) {
                $id = $receber_cadastros [ 'id' ];
                $nome = $receber_cadastros [ 'nome' ];
                $email = $receber_cadastros [ 'email' ];
               
              */
    ?>

    <tr>
        <td scope=" row "> <?php echo  $id; ?> </ td>
        <td> <input type=" text " name=" nome " value=" <?php echo  $nome; ?> "> </ td>
        <td> <input type=" text " name=" email " value=" <?php echo  $email; ?> "> </ td>


    </tr>
    <?php /* };*/ ?>

    <tr>
        <form action=" cadastro.php " method=" post ">
            <td> <input type=" text " name=" nome "> </ td>
            <td> <input type=" text " name=" telefone "> </ td>
            <td> <input type=" submit " value=" Cadastro "> </ td>
        </form>
    </tr>

</body>



</html>