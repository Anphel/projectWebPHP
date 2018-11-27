<?php
include ('Cliente.php');
//Cria o objeto da Classe Cliente
$perfil = new Cliente($_POST['nome'],$_POST['telefone'],$_POST['nascimento'],$_POST['rg'],$_POST['cpf'],$_POST['email'],MD5($_POST['senha']));
//Grava no banco usando o metodo do obj criado
if($perfil->gravarCliente($_POST['nome'],$_POST['telefone'],$_POST['nascimento'],$_POST['rg'],$_POST['cpf'],$_POST['email'],MD5($_POST['senha']))== true){
?>
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <div class="alert alert-success"  role="alert"> Cadastrado com sucesso! Ir para página de usuário: <a href="login.php" class="alert-link"> HOME</a>.
   </div>
<?php } else{ ?>
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <div class="alert alert-danger"  role="alert"> Alguns dados ja cadastrados, tente novamente <a href="index.php" class="alert-link"> HOME</a>.
   </div>
<?php } ?>


