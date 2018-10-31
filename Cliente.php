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
            $consulta = $pdo->query("SELECT idCadastro,nomeCadastro,senhaCadastro FROM cadastro WHERE nomeCadastro = '$nome' AND senhaCadastro = '$senha';") or die("Erro ao encontrar!");
            //Atrubui o resultado da busca em $linha
            $linha = $consulta->fetch(PDO::FETCH_ASSOC);
            //Condicao para a session
            if ($linha !=""){
                if (!isset($_SESSION)) session_start();
                $_SESSION['UsuarioID'] = $linha['idCadastro'];
                $_SESSION['UsuarioNome'] = $linha['nomeCadastro'];
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
        }catch(PDOException $e) {
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
                $stmt = $pdo->prepare('INSERT INTO cadastro(nomeCadastro,telefoneCadastro,nascimentoCadastro,rgCadastro,cpfCadastro,senhaCadastro) VALUES(:nome,:telefone,:nascimento,:rg,:cpf,:senha)');
                $stmt->execute(array(':nome' => $nome, ':telefone' => $telefone, ':nascimento' => $nascimento, ':rg' => $rg, ':cpf' => $cpf, 'senha' => $senha));
                
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
            $linkboots='<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />';
            echo $linkboots."<p><strong> ID:</strong>{$linha['idCadastro']}<strong> Nome:</strong>{$linha['nomeCadastro']}<strong> Telefone:</strong> {$linha['telefoneCadastro']}<strong> Nascimento:</strong>{$linha['nascimentoCadastro']}<strong> RG:</strong>{$linha['rgCadastro']}<strong> CPF:</strong>{$linha['cpfCadastro']}<p><br>";
}
    }
    function atualizarCliente($id,$nome,$telefone) //Metodo para UPDATE no banco
    {
        $link = new linkBanco();
        $pdo = ($link->linkBanco());
        $consulta = $pdo->query('SELECT idCadastro FROM cadastro;');
        $controlador = False;
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            if ($linha['idCadastro'] == $id){
                $controlador = True;
            try {
                $link = new linkBanco();
                $pdo = ($link->linkBanco());
                $stmt = $pdo->prepare("UPDATE cadastro SET nomeCadastro = :nome , telefoneCadastro = :telefone WHERE idCadastro = '$id'");
                $stmt->execute(array(':nome'   => $nome,':telefone' => $telefone));
                echo"Alteracao realizada com sucesso!";
                die();
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
        try {
            $link = new linkBanco();
            $pdo = ($link->linkBanco());
            $stmt = $pdo->prepare('DELETE FROM cadastro WHERE idCadastro = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            echo $stmt->rowCount();
        } catch(PDOException $e){
            echo 'Error: ' . $e->getMessage();
        }
    }

    }