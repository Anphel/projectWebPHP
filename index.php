
<!DOCTYPE html>
<html lang="pt-br">
<head >
<meta charset="utf-8">

<title></title>
<!-- links para pagina de estilo e o bootstrap-->
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script.js"></script> 
<script type="text/javascript" src="js/jquery-ui.custom.min.js"></script> 
<script src="/js/jqBootstrapValidation.js"></script></head>

<body>

<div id="principal"> <!-- Inicio div principal-->

<h1>Login</h1>

<form method="post" action="processaLogin.php" >
<div class="form-group">
 <label for="exampleInputEmail1">Nome:</label>
<input  type="text" class="form-control" placeholder="Digite seu nome aqui." name="nomeLogin" required ><br>
 <label for="exampleInputEmail1">Senha:</label>
<input  type="password" class="form-control" placeholder="Digite sua senha aqui." name="senhaLogin" required ><br>
<input type="submit" class="btn btn-primary" value="Login" id='login' name='btnLogin'>
</div>
</form>
<h1>Cadastro</h1>

<form method="post" action="processaCadastro.php">
<div class="form-group">
<input  type="text" class="form-control" placeholder="Nome" name="nome" required autofocus ><br>
<input  type="text" class="form-control" placeholder="Telefone" name="telefone" ><br>
<input  type="text" class="form-control" placeholder="Nascimento" name="nascimento" ><br>
<input  type="text" class="form-control" placeholder="RG" name="rg" ><br>
<input  type="text" class="form-control" placeholder="CPF" name="cpf" required ><br>
<input  type="password" class="form-control" placeholder="Senha" name="senha" required ><br>
<input type="submit" class="btn btn-primary" value="Cadastrar" id='cadastrar' name='btnCadastrar'>
</div>
</form>

</div><!-- Fim div principal-->
</body>
</html>