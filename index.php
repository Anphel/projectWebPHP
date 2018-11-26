<!DOCTYPE html>
<html lang="en">
<head>
	<title>Awesome site!</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/img-01.png');">
			<div class="wrap-login100 p-t-190 p-b-30">
				<form class="login100-form validate-form" method="post" action="processaLogin.php">
					
					<div class="wrap-input100 validate-input m-b-10" data-validate = "Necessita usuario">
						<input class="input100" type="text" name="nomeLogin" placeholder="Usuário">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Necessita senha">
						<input class="input100" type="password" name="senhaLogin" placeholder="Senha">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-10">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
					<div class="text-center w-full p-t-25 p-b-230">
						<a class="txt1" href="#" data-toggle="modal" data-target="#enviar_senhaModal" data-whatever="@mdo" >
							Esqueceu usuário/senha?
						</a>
					</div><div class="text-center w-full">
						<a class="txt1" href="#" data-toggle="modal" data-target="#cadastroModal" data-whatever="@mdo" >
							Crie uma conta
							<i class="fa fa-long-arrow-right"></i>						
						</a>
					</div>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
<!--modal Cadastro -->
<div class="modal fade" id="cadastroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<input  type="text" class="form-control" placeholder="Email" name="email" required ><br>
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
<!--modal Cadastro -->
<!--modal Enviar Senha -->
<div class="modal fade" id="enviar_senhaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="processaEnviarSenha.php">
<div class="form-group">
<input  type="text" class="form-control" placeholder="E-mail" name="email" required autofocus ><br>
</div>
		<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <input type="submit" class="btn btn-primary" id='enviar_senha' name='btnEnviarSenha'>
        </div>
      </form>
      </div>
      
    </div>
  </div>
</div>
<!--modal Enviar Senha -->
	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/js/popper.js"></script>
	<script src="/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

</html>