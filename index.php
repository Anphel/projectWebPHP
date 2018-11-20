

<!DOCTYPE html>
<html lang="pt-br">
<head >
<meta charset="utf-8">

<title></title>
<!-- links para pagina de estilo e o bootstrap-->
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="css/estilo.css" type="text/css" />
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  
</head>

<body>

<div id="principal" class="principal shadow p-3 mb-5 rounded"> <!-- Inicio div principal-->
<div id="content" class="content"> 
<h1>Login</h1>
<form method="post" action="processaLogin.php" >
<div class="form-group">
 <label for="exampleInputEmail1">Nome:</label>
<input  type="text" class="form-control" placeholder="Digite seu nome aqui." name="nomeLogin" required ><br>
 <label for="exampleInputEmail1">Senha:</label>
<input  type="password" class="form-control" placeholder="Digite sua senha aqui." name="senhaLogin" required ><br>
<input type="submit" class="btn btn-primary" value="Login" id='login' name='btnLogin'>
<a class="nav-link" href="#" data-toggle="modal" data-target="#atualizarModal" data-whatever="@mdo">Cadastrar</a>
</div>
</form>
</div>
<!--modal Cadastro -->
<div class="modal fade" id="atualizarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="processaCadastro.php">
<div class="form-group">
<input  type="text" class="form-control" placeholder="Nome" name="nome" required autofocus ><br>
<input  type="text" class="form-control" placeholder="Telefone" name="telefone" ><br>
<input  type="text" class="form-control" placeholder="Nascimento" name="nascimento" ><br>
<input  type="text" class="form-control" placeholder="RG" name="rg" ><br>
<input  type="text" class="form-control" placeholder="CPF" name="cpf" required ><br>
<input  type="password" class="form-control" placeholder="Senha" name="senha" required ><br>

</div>
		<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <input type="submit" class="btn btn-primary" value="Cadastrar" id='cadastrar' name='btnCadastrar'>
        </div>
      </form>
      </div>
      
    </div>
  </div>
</div>

</body>
</html>