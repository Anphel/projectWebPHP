<?php
if (!isset($_SESSION)) session_start();
// Verifica se n�o h� a vari�vel da sess�o que identifica o usu�rio
if (!isset($_SESSION['UsuarioID'])) {
    // Destr�i a sess�o por seguran�a
    session_destroy();
    // Redireciona o visitante de volta pro login
    // Usu�rio n�o logado! Redireciona para a p�gina de login
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
