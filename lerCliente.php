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

<a href="login.php"><input type="submit" class="btn btn-primary" value="Voltar"/></a>
<br><br>
<?php
include ('Cliente.php');
$perfil = new Cliente();
$perfil->lerCliente();
?>
