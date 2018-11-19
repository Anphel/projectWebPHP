<?php
if (!isset($_SESSION)) session_start();
// Verifica se não há a variável da sessão que identifica o usuário
$nivel_necessario = 1;
if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioTipo'] < $nivel_necessario) ) {
    // Destrói a sessão por segurança
    // Redireciona o visitante de volta pro login
    // Usuário não logado! Redireciona para a página de login
    header("Location:login2.php");
    exit;
}
include ('Cliente.php');
$perfil = new Cliente();
$perfil->add_saldoCliente($_POST['id'],$_POST['saldo']);
