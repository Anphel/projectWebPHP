<?php
class linkBanco
{
    function linkBanco() {
        $user = 'id7917802_anphel';//usuario do banco
        $pass = 'QWEasd123!';//senha do banco
        $pdo = new PDO('mysql:host=localhost;dbname=id7917802_bdprincipal000', $user, $pass);//objeto com PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        return $pdo;
    }
}
class Cliente extends linkBanco
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
            $obj = new Cliente;
            $pdo = ($obj->linkBanco());
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
                return true;
                }else{
                //Caso nao encontre o login ou a senha
                return false;
            }
        
    }
    function enviar_senhaCliente($email){
        $obj = new Cliente;
        $pdo = ($obj->linkBanco());
        $consulta = $pdo->query("SELECT idCadastro,emailCadastro,senhaCadastro FROM cadastro WHERE emailCadastro = '$email'");
        $linha = $consulta->fetch(PDO::FETCH_ASSOC);
       $id = $linha['idCadastro'];
       $novaSenha = rand(999, 99999);
       $novaSenha_hash = md5($novaSenha);
        if($linha['emailCadastro'] == $email){
                //query para dar update no banco os dados recebidos pela funcao
                $stmt = $pdo->prepare("UPDATE cadastro SET senhaCadastro = :novaSenha WHERE idCadastro = :id");
                $stmt->execute(array(':novaSenha'   => $novaSenha_hash,':id' => $id));
                
                $to      = $email;
                $subject = 'Resetar senha';
                $message = 'Sua nova senha: ' . $novaSenha;
                $headers = 'From: fullbuster.andre@gmail.com' . "\r\n" .
                'Reply-To: fullbuster.andre@gmail.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);
            $result='<link rel="stylesheet" href="css/bootstrap.css" type="text/css" /><div class="alert alert-successs" role="alert">
            E-mail enviado, consulte-o para ter acesso a sua senha! Voltar a pagina princial <a href="index.php" class="alert-link"> HOME</a>.
            </div>';
            echo $result;
        } else{

            $result='<link rel="stylesheet" href="css/bootstrap.css" type="text/css" /><div class="alert alert-danger" role="alert">
               E-mail não cadastrado, tente outros! Voltar a pagina princial <a href="index.php" class="alert-link"> HOME</a>.
               </div>';
        }

    }
    function gravarCliente($nome,$telefone,$nascimento,$rg,$cpf,$email,$senha)//Metodo INSERT no banco
    {   
        $obj = new Cliente();
           if($obj->verificaCliente($nome,$telefone,$rg,$cpf) == true){
                //Inserindo no banco usando statement pdo
                $pdo = ($obj->linkBanco());
                $stmt = $pdo->prepare('INSERT INTO cadastro(nomeCadastro,telefoneCadastro,nascimentoCadastro,rgCadastro,cpfCadastro,senhaCadastro,diretorio_fotoCadastro,tipoCadastro,emailCadastro) VALUES(:nome,:telefone,:nascimento,:rg,:cpf,:senha,:diretorio_fotoCadastro,:tipoCadastro,:email)');
                $stmt->execute(array(':nome' => $nome, ':telefone' => $telefone, ':nascimento' => $nascimento, ':rg' => $rg, ':cpf' => $cpf, 'senha' => $senha,':diretorio_fotoCadastro' => 'https://anphel2.000webhostapp.com/upload/DefaultUser.jpg', ':tipoCadastro' => 1, ':email' => $email));
                if ($obj->logarCliente($nome, $senha) == true){//loga o cliente apos fazer o cadastro
                    return true;//retorna bool
                    }
                }
            else{
                 return false;
               //Mensagem de erro no cadastro
                }
        }
    
        function verificaCliente($nome,$telefone,$rg,$cpf){
            $obj = new Cliente();
            $pdo = ($obj->linkBanco());
            $consulta = $pdo->query("SELECT nomeCadastro,telefoneCadastro,rgCadastro,cpfCadastro,emailCadastro FROM cadastro WHERE nomeCadastro ='$nome' OR telefoneCadastro='$telefone' OR rgCadastro='$rg' OR cpfCadastro='$cpf';"); // Faz a consulta de Query
            $linha = $consulta->fetch(PDO::FETCH_ASSOC); // Coloca em uma variavel o resultado da consulta
            if($linha['nomeCadastro'] == $nome || $linha['telefoneCadastro'] == $telefone || $linha['rgCadastro'] == $rg || $linha['cpfCadastro'] == $cpf){
                return false;
            }else{
                return true;
            }
    
    }
    function lerCliente() //Metodo para SELECT do banco
    {
        $obj = new Cliente;
        $pdo = ($obj->linkBanco());
        $stmt = $pdo->prepare('SELECT * FROM cadastro;');
        $query = "";
        $stmt->execute(array($query));
        return $data = $stmt->fetchAll();//retorna um array com toda a consulta no banco

    }
    function atualizarCliente($id,$nome,$telefone,$nascimento,$rg,$cpf,$email) //Metodo para UPDATE no banco
    {
        $obj = new Cliente;
        $pdo = ($obj->linkBanco());
        $consulta = $pdo->query('SELECT idCadastro FROM cadastro;');//realiza select do id para comparar com o id digitado
        $controlador = False;//variavel controladora para verificar se o id foi encontrado
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            if ($linha['idCadastro'] == $id){
                $controlador = True;//atribui o valor para a variavel controladora
            
                //query para dar update no banco os dados recebidos pela funcao
                $stmt = $pdo->prepare("UPDATE cadastro SET nomeCadastro = :nome , telefoneCadastro = :telefone ,nascimentoCadastro = :nascimento , rgCadastro = :rg, cpfCadastro = :cpf , emailCadastro = :email WHERE idCadastro = '$id'");
                $stmt->execute(array(':nome'   => $nome,':telefone' => $telefone,':nascimento'   => $nascimento,':rg'   => $rg,':cpf'   => $cpf,':email'   => $email));
                echo'<link rel="stylesheet" href="css/bootstrap.css" type="text/css" /><div class="alert alert-success" role="alert">
               Atualizado com sucesso, <a href="lerCliente.php" class="alert-link"> CLIQUE AQUI!</a>
               </div>';
            
            }
        }
        if($controlador == False){
            echo"ID nao encontrada, por favor insira outro!";
        }
      }
    function deletarCliente($id)  //Metodo para DELET no banco
    { 
        $obj = new Cliente;
        $pdo = ($obj->linkBanco());
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
        $obj = new Cliente;
        $pdo = ($obj->linkBanco());
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

    if (isset($submit)) {
        if (! in_array($fileExtension,$fileExtensions)) {
            $errors[] = "Esse tipo de arquivo n�o � aceito, por favor carregie um JPEG ou PNG";
        }
        if ($fileSize > 2000000) {
            $errors[] = "Esse arquivo tem mais de 2MB. Lementamos, porem o arquivo dever ter menos de 2MB";
        }
        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
            if ($didUpload) {
                $obj = new Cliente;
                $pdo = ($obj->linkBanco());
                //query para dar update no banco os dados recebidos pela funcao
                $diretorio = "https://anphel2.000webhostapp.com/upload/".$fileName;
                $stmt = $pdo->prepare("UPDATE cadastro SET diretorio_fotoCadastro = :diretorio  WHERE idCadastro = :id");
                $stmt->execute(array(':diretorio'  => $diretorio,':id' => $id));
                $_SESSION['UsuarioFoto'] = $diretorio ;
                echo'<link rel="stylesheet" href="css/bootstrap.css" type="text/css" /><div class="alert alert-success" role="alert">
               O Arquivo, ' . basename($fileName) . ' foi salvo <a href="login.php" class="alert-link"> CLIQUE AQUI!</a>
               </div>';

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

