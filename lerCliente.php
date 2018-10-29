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

<a href="login.php"><input type="submit" class="btn btn-primary" value="Voltar"/></a>
<br><br>
<?php
include ('Cliente.php');
$perfil = new Cliente();
$perfil->lerCliente();
?>
