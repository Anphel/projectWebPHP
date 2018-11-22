<?php
if (!isset($_SESSION)) session_start();
// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID'])) {
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    // Usuário não logado! Redireciona para a página de login
    header("Location:index.php");
    exit;
}
?>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="css/estilo.css" type="text/css" />
<div class="lerCliente">

<div class="alert alert-dark" role="alert"><strong>Clientes cadastrados</strong><a href="login.php"><input type="submit" class="btn btn-primary" value="Voltar" style="margin-left: 85%;" /></a> </div>

</div>
<table class='table'>
  <thead class='thead-dark'>
    <tr>
      <th scope='col'>ID</th>
      <th scope='col'>Tipo</th>
      <th scope='col'>Nome</th>
      <th scope='col'>Telefone</th>
      <th scope='col'>RG</th>
      <th scope='col'>CPF</th>
      <th scope='col'>Saldo</th>
     <th scope='col'></th>
    </tr>
  </thead> 
  <tbody>
<?php
include ('Cliente.php');
$perfil = new Cliente();
$perfil->lerCliente();
?>
