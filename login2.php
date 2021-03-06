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
<head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
  <a class="navbar-brand" href="login.php"><i class="fas fa-home fa-lg"></i>  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="lerCliente.php">Ler cliente </a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#deletarModal" data-whatever="@mdo">Deletar cliente </a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#atualizarModal" data-whatever="@mdo">Atualizar cliente </a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#saldoModal" data-whatever="@mdo">Saldo cliente </a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="logout.php">Sair</a>
      </li>
    </ul>
    
  </div>
  <a class="nav-link" target="_blank" href="https://www.facebook.com/"><i class="fab fa-facebook-square fa-2x"  style="color: Dodgerblue;"></i> </a>
  <a class="nav-link" target="_blank" href="https://twitter.com/"><i class="fab fa-twitter-square fa-2x" style="color: Dodgerblue;"></i></a>
  
</nav>

<body>
  <h5 class="card-title"> Bem vindo(a), <strong><?php echo $_SESSION['UsuarioNome'] ?></strong>!</h5>
<img src="<?php echo $_SESSION['UsuarioFoto'] ?>" alt="Cap" class="img-thumbnail" style="max-width: 200px; max-height: auto;" ><br>
       
       <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="custom-file">
  <input type="file" name="myfile" class="custom-file-input" id="fileToUpload">
  <label class="custom-file-label" style="max-width: 13%" for="customFile">Escola a foto</label>
  <input type="submit" name="submit" class="btn btn-dark" value="Carregar" >
</div>
        
    </form>
<!--modal Atualizar -->
<div class="modal fade" id="atualizarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Atualizar cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="processaAtualizar.php">
<div class="form-group">
<input  type="text" class="form-control" placeholder="ID" name="id" required autofocus ><br>
<input  type="text" class="form-control" placeholder="Nome" name="nome" required><br>
<input  type="text" class="form-control" placeholder="Telefone" name="telefone" ><br>
<input  type="text" class="form-control" placeholder="Nascimento" name="nascimento" ><br>
<input  type="text" class="form-control" placeholder="RG" name="rg" required><br>
<input  type="text" class="form-control" placeholder="CPF" name="cpf" required ><br>
</div>
		<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Atualizar" id='atualizar' name='btnAtualizar' disabled>
        </div>
      </form>
      </div>
      
    </div>
  </div>
</div>
<!--fim modal Atualizar -->
<!--modal Deletar -->
<div class="modal fade" id="deletarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deletar cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="processaDeletar.php">
		<div class="form-group">
<input  type="text" class="form-control" placeholder="ID" name="id" required autofocus ><br>
		</div>
		<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Deletar" id='Deletar' name='btnDeletar' disabled>
        </div>
      </form>
      </div>
      
    </div>
  </div>
</div>
<!--fim modal Deletar -->

<!--modal Saldo -->
<div class="modal fade" id="saldoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Saldo cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="processaSaldo.php">
		<div class="form-group">
<input  type="text" class="form-control" placeholder="ID" name="id" required autofocus ><br>
<input  type="text" class="form-control" placeholder="Saldo" name="saldo" required ><br>
		</div>
		<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Concluir" id='Saldo' name='btnSaldo' disabled>
        </div>
      </form>
      </div>
      
    </div>
  </div>
</div>
<!--fim modal Saldo -->
</body>

