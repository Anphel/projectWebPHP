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
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script.js"></script> 
<script type="text/javascript" src="js/jquery-ui.custom.min.js"></script> 
<script src="/js/jqBootstrapValidation.js"></script></head>

<br>	
<a href="login.php"><input type="submit" class="btn btn-primary" value="Voltar"/></a>
<br><br>

<form method="post" action="processaAtualizar.php">
<div class="form-group">
<input  type="text" class="form-control" placeholder="ID" name="id" required autofocus ><br>
<input  type="text" class="form-control" placeholder="Nome" name="nome" required><br>
<input  type="text" class="form-control" placeholder="Telefone" name="telefone" required><br>
<input type="submit" class="btn btn-primary" value="Atualizar" id='atualizar' name='btnAtualizar'>
</div>
</form>
	
