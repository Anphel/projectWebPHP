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
include ('Cliente.php');
$perfil = new Cliente();
$perfil->atualizarCliente($_POST['id'], $_POST['nome'],$_POST['telefone'],$_POST['nascimento'],$_POST['rg'],$_POST['cpf']);