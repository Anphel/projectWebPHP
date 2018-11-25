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
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="css/estilo.css" type="text/css" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<!--NAV-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
  <a class="navbar-brand" href="login.php"><i class="fas fa-home fa-lg"></i>  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="lerCliente.php">Ler cliente</a>
      </li>
       
       <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#saldoModal" data-whatever="@mdo">Saldo cliente</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php" >Sair</a>
      </li>

    </ul>
    
  </div>
</nav>

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
<div class="lerCliente">
<div class="alert alert-dark" role="alert">Clientes cadastrados</div>

</div>
<table class='table'>
  <thead class='thead-dark'>
    <tr>
      <th scope='col'>ID</th>
      <th scope='col'>Tipo</th>
      <th scope='col'>Nome</th>
      <th scope='col'>Telefone</th>
      <th scope='col'>Nascimento</th>
      <th scope='col'>RG</th>
      <th scope='col'>CPF</th>
      <th scope='col'>Email</th>
      <th scope='col'>Saldo</th>
      <th scope='col'></th>
    </tr>
  </thead> 
  <tbody>
<?php
include ('Cliente.php');
$perfil = new Cliente();
$data = $perfil->lerCliente();?>
<?php foreach($data as $row): ?>
  <tr>
    <th scope="row"><?=$row['idCadastro']?></th>
    <td><?=$row['tipoCadastro']?></td>
    <td><?=$row['nomeCadastro']?></td>
    <td><?=$row['telefoneCadastro']?></td>
    <td><?=$row['nascimentoCadastro']?></td>
    <td><?=$row['rgCadastro']?></td>
    <td><?=$row['cpfCadastro']?></td>
    <td><?=$row['emailCadastro']?></td>
    <td><?=$row['saldoCadastro']?></td>
    <!--modal Atualizar -->
<div class="modal fade" id="atualizar<?=$row['idCadastro']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<input  type="text" class="form-control" placeholder="ID" name="id" value="<?=$row['idCadastro']?>" ><br>
<input  type="text" class="form-control" placeholder="Nome" value="<?=$row['nomeCadastro']?>" name="nome" required><br>
<input  type="text" class="form-control" placeholder="Telefone" value="<?=$row['telefoneCadastro']?>" name="telefone" ><br>
<input  type="text" class="form-control" placeholder="Nascimento" value="<?=$row['nascimentoCadastro']?>" name="nascimento" ><br>
<input  type="text" class="form-control" placeholder="RG" value="<?=$row['rgCadastro']?>" name="rg" required><br>
<input  type="text" class="form-control" placeholder="CPF" value="<?=$row['cpfCadastro']?>" name="cpf" required ><br>
<input  type="text" class="form-control" placeholder="Email" value="<?=$row['emailCadastro']?>" name="email" required><br>
</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Atualizar" id='atualizar' name='btnAtualizar'>
        </div>
      </form>
      </div>
      
    </div>
  </div>
</div>
<!--fim modal Atualizar -->
<!--modal Deletar -->
<div class="modal fade" id="deletar<?=$row['idCadastro']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<input  type="" class="form-control" placeholder="ID" name="id" value="<?=$row['idCadastro']?>" ><br>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Nao</button>
        <input type="submit" class="btn btn-success" value="Sim" id='Deletar' name='btnDeletar'>
        </div>
      </form>
      </div>
      
    </div>
  </div>
</div>
<!--fim modal Deletar -->
    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#atualizar<?=$row['idCadastro']?>" data-whatever="@mdo">Editar</button>
        <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#deletar<?=$row['idCadastro']?>" data-whatever="@mdo">Deletar</button>
    </td>
  </tr>
<?php




 endforeach ?>

  </tbody>
</table>


    <footer class="page-footer font-small mdb-color darken-3 pt-4">
    <!-- Footer Elements -->
    <div class="container">
      <!--Grid row-->
      <div class="row d-flex justify-content-center">
        <!--Grid column-->
        <div class="col-md-6">
          <div class="social">
<a target="_blank" class="card-img-top"  href="https://www.facebook.com/andre.phelipe.12"><i class="fab fa-facebook fa-3x"></i></a>
<a target="_blank" class="card-img-top"  href="https://api.whatsapp.com/send?phone=5541997506431"><i class="fab fab fa-whatsapp fa-3x"></i></a>
     </div>
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </div>
    <!-- Footer Elements -->
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">2018 Copyright
      <a href="https://github.com/Anphel"> André Phelipe</a>
    </div>
  </footer>
      <!-- Footer -->
