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
?>
<head>
  <link rel="stylesheet" href="css/main.css" type="text/css" />
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
  <!--NAV-->
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
        <a class="nav-link" href="logout.php">Sair </a>
      </li>
       
    </ul>
    
  </div>
  
  </nav>
  <!--NAV-->
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
        <input type="submit" class="btn btn-primary" value="Concluir" id='Saldo' name='btnSaldo'>
        </div>
      </form>
      </div>
      
    </div>
  </div>
  </div>
  <!--fim modal Saldo -->
<div class="container">
  <h5 class="card-title"> Bem vindo(a), <strong><?php echo $_SESSION['UsuarioNome'] ?></strong>!</h5>
  <img src="<?php echo $_SESSION['UsuarioFoto'] ?>" alt="Cap" class="img-thumbnail" style="max-width: 15%; max-height: auto;" /><br>
       
       <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="custom-file">
  <input type="file" name="myfile" class="custom-file-input" id="fileToUpload">
  <label class="custom-file-label" style="max-width: 13%" for="customFile">Escolha a foto</label>
  <input type="submit" name="submit" class="btn btn-dark" value="Carregar" >
  </div> 

  </form> 
  <br>
</div>
  <footer class="page-footer font-small mdb-color darken-3 pt-4">
    <!-- Footer Elements -->
    <div class="container">
      <!--Grid row-->
      <div class="row d-flex justify-content-center">
        <!--Grid column-->
        <div class="col-md-6">
      <div class="social">
    <a target="_blank"   href="https://www.facebook.com/andre.phelipe.12"><i class="fab fa-facebook fa-3x"></i></a>
    <a target="_blank" data-toggle="tooltip" data-placement="top" title="Numero: 5541997506431"  href="https://wa.me/5541997506431?text=Olá%20André%20!"><i class="fab fab fa-whatsapp fa-3x"></i></a>

     </div>
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </div>
    <!-- Footer Elements -->
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">2018 Copyright
      <a target="_blank" href="https://github.com/Anphel"> André Phelipe</a>
    </div>
  </footer>
      <!-- Footer -->
</body>
 