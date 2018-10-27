<?php session_start(); session_destroy(); header("Location: index.php");exit; ?>

<?php

if (!isset($_SESSION)) session_start();
// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioNome'])) {
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: index.php"); exit;
}
?> 
  