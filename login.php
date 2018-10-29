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

<nav class="nav nav-pills nav-justified">
  <a class="nav-link active" href="index.php">Home</a>
  <a class="nav-link" href="lerCliente.php">Ler cliente</a>
  <a class="nav-link" href="atualizarCliente.php">Atualizar cliente</a>
  <a class="nav-link" href="logout.php">Sair</a>
</nav>

<body>
<h2>Bem vindo(a), <?php echo $_SESSION['UsuarioNome']; ?></h2>
</body>