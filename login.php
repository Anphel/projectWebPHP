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