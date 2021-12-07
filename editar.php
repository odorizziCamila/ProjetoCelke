<?php
include_once 'conexao.php';
session_start();
ob_start();

?>
<?php

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT); // uma variavel vai receber o id

//var_dump($id);

if (empty($id)) { // verifica se a variavel esta vazia.
    $_SESSION['msg'] = "<p style='color: red'>Erro: usuário nao encontrado!!</p>";
    header("Location: index.php");
    exit();
}

$query_usuario = "SELECT * FROM crudphp.tb_cliente WHERE ID = $id LIMIT 1";
$result_usuario = $conexao->prepare($query_usuario);
$result_usuario->execute();

if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);// quando eu utilizo o fetch assoc consigo imprimir utilizando o nome atraves da coluna.
    //var_dump($row_usuario);
   
} else {
    $_SESSION['msg'] = "<p style='color:red'>Erro: Usuáio não encontrado:</p>";
    header("location:index.php");
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
    // Receber os dados atraves do formulario
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
   // var_dump($dados);
   // verifica se usuario clicou no botao
    if(!empty($dados['EditUsuario'])){
        $empty_input = false;
        $dados = array_map("trim", $dados);
        if(in_array("", $dados)){
            $empty_input =true;
            echo "<p style='color:red;'> Necessário preencher todos os campos</p>";
        }
        if(!$empty_input){
            //echo "Editar";
            $query_up_usuario="UPDATE crudphp.tb_cliente set nome=:nome, email=:email where id=:id";
            $edit_usuario =$conexao-> prepare($query_up_usuario);
            $edit_usuario-> bindParam(':nome',$dados['nome'],PDO::PARAM_STR);
            $edit_usuario-> bindParam(':email',$dados['email'],PDO::PARAM_STR);
            $edit_usuario-> bindParam(':id',$id,PDO::PARAM_INT);

            if($edit_usuario->execute()){
                $_SESSION['msg']= "<p style='color:green;'> Usuario editado com sucesso</p>";
                header("location:index.php");
            }else {
               echo "<p style='color:red;'> Usuáio não editado com sucesso</p>";
            }
            
        }
    }

        
        //var_dump($dados);
    
    
    ?>


    <form id ="edita-usuario" method="POST" action="">
        <label>Nome:</label>
        <input type="text" name="nome" id="nome" placeholder="Nome completo" value="<?php if(isset($dados['nome'])){
             echo $dados['nome'];
            }elseif(isset($row_usuario['nome'])){
                 echo $row_usuario['nome'];
            }
             ?>"require><br>
        
        
        <label>E-mail:</label>
        <input type="email" name="email" id="nome" placeholder="melhor email" value="<?php if(isset($dados['email'])){
             echo $dados['email'];
            }elseif(isset($row_usuario['email'])){
                 echo $row_usuario['email'];
            }
             ?>"require><br>
        <input type="submit" value="Salvar" name="EditUsuario">


    </form>
    <?php

    ?>

</body>

</html>