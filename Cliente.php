<?php
include ('linkBanco.php');
class Cliente
{
    //Classe com os metodos e atributos referente ao cliente
    //Atributos
    function __construct()
    {
      //Metodo construtor
    }
    function __destruct()
    {
      //Metodo destrutor
    }

    function logarCliente($nome,$senha)  //Metodo para logar no sistema
    {
        try{
            $link = new linkBanco();
            $pdo = ($link->linkBanco());
            //Query que busca o login e a senha
            $consulta = $pdo->query("SELECT idCadastro,nomeCadastro,senhaCadastro,diretorio_fotoCadastro,tipoCadastro FROM cadastro WHERE nomeCadastro = '$nome' AND senhaCadastro = '$senha';") or die("Erro ao encontrar!");
            //Atrubui o resultado da busca em $linha
            $linha = $consulta->fetch(PDO::FETCH_ASSOC);

            //Condicao para a session
            if ($linha['idCadastro'] != '' ){
                    if (!isset($_SESSION)) session_start();
                $_SESSION['UsuarioID'] = $linha['idCadastro'];
                $_SESSION['UsuarioTipo'] = $linha['tipoCadastro'];
                $_SESSION['UsuarioNome'] = $linha['nomeCadastro'];
                $_SESSION['UsuarioFoto'] = $linha['diretorio_fotoCadastro'];//Session para armazenar o caminho da foto de perfil
                header("Location:login.php"); exit;
                }else{
                //Caso nao encontre o login ou a senha
                $result='<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
               <div class="alert alert-danger" role="alert">
               '.$nome.' inexistente e/ou senha incorreta, tente outro! Voltar a pagina princial <a href="index.php" class="alert-link"> HOME</a>.
               </div>';
                echo $result;
                die();
            }
        }catch(PDOException $e) { //cath para mostrar na tela mensagem de erro caso ocorra
            echo 'Error: ' . $e->getMessage();
        }
    }
    function gravarCliente($nome,$telefone,$nascimento,$rg,$cpf,$senha)//Metodo INSERT no banco
    {
        try {
            $link = new linkBanco(); // Faz o link com o banco
            $pdo = ($link->linkBanco());
            $consulta = $pdo->query("SELECT nomeCadastro,telefoneCadastro,rgCadastro,cpfCadastro FROM cadastro WHERE nomeCadastro ='$nome' OR telefoneCadastro='$telefone' OR rgCadastro='$rg' OR cpfCadastro='$cpf';"); // Faz a consulta de Query
            $linha = $consulta->fetch(PDO::FETCH_ASSOC); // Coloca em uma variavel o resultado da consulta
           //Condicao para gravar no banco os dados 
            if($linha['nomeCadastro'] == $nome || $linha['telefoneCadastro'] == $telefone || $linha['rgCadastro'] == $rg || $linha['cpfCadastro'] == $cpf){ // Faz a comparação do resultado da consulta com a variavel a ser cadastrada
               //Mensagem de erro no cadastro
               $result='<link rel="stylesheet" href="css/bootstrap.css" type="text/css" /><div class="alert alert-danger" role="alert">
               Alguns dados ja cadastrados, tente outros! Voltar a pagina princial <a href="index.php" class="alert-link"> HOME</a>.
               </div>';
                 echo $result;
                    die();
                }
                else{

                //Inserindo no banco usando statement pdo
                $stmt = $pdo->prepare('INSERT INTO cadastro(nomeCadastro,telefoneCadastro,nascimentoCadastro,rgCadastro,cpfCadastro,senhaCadastro,diretorio_fotoCadastro,tipoCadastro) VALUES(:nome,:telefone,:nascimento,:rg,:cpf,:senha,:diretorio_fotoCadastro,:tipoCadastro)');
                $stmt->execute(array(':nome' => $nome, ':telefone' => $telefone, ':nascimento' => $nascimento, ':rg' => $rg, ':cpf' => $cpf, 'senha' => $senha,':diretorio_fotoCadastro' => 'https://anphel2.000webhostapp.com/upload/DefaultUser.jpg', ':tipoCadastro' => 1));
                $result='<link rel="stylesheet" href="css/bootstrap.css" type="text/css" /><div class="alert alert-success"  role="alert">'.$nome.'
                cadastrado com sucesso! Voltar a pagina inicial<a href="index.php" class="alert-link"> HOME</a>.
               </div>';
                echo $result;
                //Mensagem de cadastro concluido 
                }
        }
        catch(PDOException $e) {
            //Mostrar na tela exception 
            echo 'Error: ' . $e->getMessage();
        }
    }
    function lerCliente() //Metodo para SELECT do banco
    {
       
        $link = new linkBanco();
        $pdo = ($link->linkBanco());
        $consulta = $pdo->query('SELECT * FROM cadastro;');

        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            echo"
    <tr>
      <th scope='row'>{$linha['idCadastro']}</th>
      <td>{$linha['tipoCadastro']}</td>
      <td>{$linha['nomeCadastro']}</td>
      <td>{$linha['telefoneCadastro']}</td>
      <td>{$linha['rgCadastro']}</td>
      <td>{$linha['cpfCadastro']}</td>
      <td>{$linha['saldoCadastro']} R$</td>
      <td><button type='button' class='btn btn-secondary'>Alterar</button>
      <button type='button' class='btn btn-secondary'>Excluir</button></td>
    </tr>
  </tbody>
";
}
echo "</table>";
    }
    function atualizarCliente($id,$nome,$telefone,$nascimento,$rg,$cpf) //Metodo para UPDATE no banco
    {
        $link = new linkBanco();
        $pdo = ($link->linkBanco());
        $consulta = $pdo->query('SELECT idCadastro FROM cadastro;');//realiza select do id para comparar com o id digitado
        $controlador = False;//variavel controladora para verificar se o id foi encontrado
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            if ($linha['idCadastro'] == $id){
                $controlador = True;//atribui o valor para a variavel controladora
            try {
                //query para dar update no banco os dados recebidos pela funcao
                $stmt = $pdo->prepare("UPDATE cadastro SET nomeCadastro = :nome , telefoneCadastro = :telefone ,nascimentoCadastro = :nascimento , rgCadastro = :rg, cpfCadastro = :cpf WHERE idCadastro = '$id'");
                $stmt->execute(array(':nome'   => $nome,':telefone' => $telefone,':nascimento'   => $nascimento,':rg'   => $rg,':cpf'   => $cpf));
                echo'<link rel="stylesheet" href="css/bootstrap.css" type="text/css" /><div class="alert alert-success" role="alert">
               Atualizado com sucesso, <a href="login.php" class="alert-link"> CLIQUE AQUI!</a>
               </div>';
            }catch(PDOException $e){
                    echo 'Error: ' . $e->getMessage();
                }
            }
        }
        if($controlador == False){
            echo"ID nao encontrada, por favor insira outro!";
        }
      }
    function deletarCliente($id)  //Metodo para DELET no banco
    { 
        $link = new linkBanco();
        $pdo = ($link->linkBanco());
        $consulta = $pdo->query('SELECT idCadastro FROM cadastro;');//realiza select do id para comparar com o id digitado
        $controlador = False;//variavel controladora para verificar se o id foi encontrado
        
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            if ($linha['idCadastro'] == $id){
                $controlador = True;//atribui o valor para a variavel controladora
                try {
                    //Query para realizar o DELETE na tabela cadastro
                    $stmt = $pdo->prepare('DELETE FROM cadastro WHERE idCadastro = :id');
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
            echo'<link rel="stylesheet" href="css/bootstrap.css" type="text/css" /><div class="alert alert-success" role="alert">
               Deletado com sucesso, <a href="login.php" class="alert-link"> CLIQUE AQUI!</a>
               </div>';
                }catch(PDOException $e){
                    echo 'Error: ' . $e->getMessage();
                }
            }
        }
        if($controlador == False){
            echo"ID nao encontrada, por favor insira outro!";
        }
    }
    function add_saldoCliente($id,$saldo){
        $link = new linkBanco(); // Faz o link com o banco
        $pdo = ($link->linkBanco());
        $consulta = $pdo->query("SELECT idCadastro,saldoCadastro FROM cadastro WHERE idCadastro ='$id'"); // Faz a consulta de Query
        $controlador = False;//variavel controladora para verificar se o id foi encontrado
        $linha = $consulta->fetch(PDO::FETCH_ASSOC); // Coloca em uma variavel o resultado da consulta
        
        if($linha['idCadastro'] == $id && $linha['saldoCadastro']>= 0){
            $controlador = True;//atribui o valor para a variavel controladora
            $saldo += $linha['saldoCadastro'];
            try {
                //query para dar update no banco os dados recebidos pela funcao
                $stmt = $pdo->prepare("UPDATE cadastro SET saldoCadastro = :saldo WHERE idCadastro = :id");
                $stmt->execute(array(':saldo'   => $saldo,':id' => $id));
                echo'<link rel="stylesheet" href="css/bootstrap.css" type="text/css" /><div class="alert alert-success" role="alert">
               Saldo atualizado com sucesso, <a href="login.php" class="alert-link"> CLIQUE AQUI!</a>
               </div>';
            }catch(PDOException $e){
                echo 'Error: ' . $e->getMessage();
            }
        }
        if($controlador == False){
            echo"ID nao encontrada, por favor insira outro!";
        }
    }
    function uploadFoto($submit,$id){

    $currentDir = getcwd();
    $uploadDirectory = "/upload/";// Diretorio de upload
    $errors = []; // Guarda erros
    $fileExtensions = ['jpeg','jpg','png']; // Extencoes dos arquivos
    $fileName = $_FILES['myfile']['name'];
    $fileSize = $_FILES['myfile']['size'];
    $fileTmpName  = $_FILES['myfile']['tmp_name'];
    $fileType = $_FILES['myfile']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));

    $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 

   // $pontos = array("C:","\x","ampp\htdocs");
   // $result = str_replace($pontos, "", $uploadPath);//funcao para retirar parte do caminho que vai ser salvo no banco, pois o caminho completo nao funciona em localhost
   
    if (isset($submit)) {
        if (! in_array($fileExtension,$fileExtensions)) {
            $errors[] = "Esse tipo de arquivo não é aceito, por favor carregie um JPEG ou PNG";
        }
        if ($fileSize > 2000000) {
            $errors[] = "Esse arquivo tem mais de 2MB. Lementamos, porem o arquivo dever ter menos de 2MB";
        }
        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
            if ($didUpload) {
                $link = new linkBanco();
                $pdo = ($link->linkBanco());
                try {
                //query para dar update no banco os dados recebidos pela funcao
                $diretorio = "https://anphel2.000webhostapp.com/upload/".$fileName;
                $stmt = $pdo->prepare("UPDATE cadastro SET diretorio_fotoCadastro = :diretorio  WHERE idCadastro = :id");
                $stmt->execute(array(':diretorio'  => $diretorio,':id' => $id));
                $_SESSION['UsuarioFoto'] = $diretorio ;
                echo'<link rel="stylesheet" href="css/bootstrap.css" type="text/css" /><div class="alert alert-success" role="alert">
               O Arquivo, ' . basename($fileName) . ' foi salvo <a href="login.php" class="alert-link"> CLIQUE AQUI!</a>
               </div>';

            }catch(PDOException $e){
                   // echo 'Error: ' . $e->getMessage();
                }
                
            } else {
                echo "Ocorreu algum erro, tente novamente ou contate um administrador.";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "Esse sao os erros" . "\n";
            }
        }
    }

    }

    }