<?php
if (!isset($_SESSION)) session_start();
// Verifica se n�o h� a vari�vel da sess�o que identifica o usu�rio
$nivel_necessario = 1;
if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioTipo'] < $nivel_necessario) ) {
    // Destr�i a sess�o por seguran�a
    // Redireciona o visitante de volta pro login
    // Usu�rio n�o logado! Redireciona para a p�gina de login
    header("Location:login2.php");
    exit;
}
include ('Cliente.php');
$perfil = new Cliente();
$perfil->add_saldoCliente($_POST['id'],$_POST['saldo']);
