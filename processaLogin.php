<?php
include ('Cliente.php');
$perfil = new Cliente($_POST['nomeLogin'],MD5($_POST['senhaLogin']));
if($perfil->logarCliente($_POST['nomeLogin'], MD5($_POST['senhaLogin']))== true){
    header("Location:login.php");
}else{?>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<div class="alert alert-danger" role="alert">Login inexistente e/ou senha incorreta, tente outro! Voltar a pagina princial<a href="index.php" class="alert-link"> HOME</a>.
<?php } ?>