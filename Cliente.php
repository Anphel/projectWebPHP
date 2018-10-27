<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script.js"></script> 
<script type="text/javascript" src="js/jquery-ui.custom.min.js"></script> 
<script src="/js/jqBootstrapValidation.js"></script></head>
<?php

include ('linkBanco.php');
class Cliente
{
    //Classe com os metodos e atributos referente ao cliente
    //Atributos
    public $nome;
    public $telefone;
    public $nascimento;
    public $rg;
    public $cpf;
    public $senha;
    
    //Metodos
    public function __construct()
    {
        
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
            $consulta = $pdo->query("SELECT nomeCadastro,senhaCadastro FROM cadastro WHERE nomeCadastro = '$nome' AND senhaCadastro = '$senha';") or die("Erro ao encontrar!");
            //Atrubui o resultado da busca em $linha
            $linha = $consulta->fetch(PDO::FETCH_ASSOC);
            //Condicao para a session
            if ($linha !=""){
                if (!isset($_SESSION)) session_start();
                $_SESSION['UsuarioNome'] = $linha['nomeCadastro'];
                header("Location: login.php"); exit;
            }else{
                //Caso nao encontre o login ou a senha
                $result='<div class="alert alert-danger" role="alert">
               '.$nome.' inexistente e/ou senha incorreta, tente outro! Voltar a pagina princial <a href="index.html" class="alert-link"> HOME</a>.
               </div>';
                echo $result;
                die();
            }
            echo $linha['nomeCadastro'],'    ', $linha['senhaCadastro'];
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    function gravarCliente($nome,$telefone,$nascimento,$rg,$cpf,$senha)//Metodo INSERT no banco
    {
        try {
            $link = new linkBanco(); // Faz o link com o banco
            $pdo = ($link->linkBanco());
            $consulta = $pdo->query("SELECT nomeCadastro FROM cadastro WHERE nomeCadastro ='$nome';"); // Faz a consulta de Query
            
            $linha = $consulta->fetch(PDO::FETCH_ASSOC); // Coloca em uma variavel o resultado da consulta
           //Condicao para gravar no banco os dados 
           if($linha['nomeCadastro'] == $nome){ // Faz a comparação do resultado da consulta com a variavel a ser cadastrada
               //Mensagem de erro no cadastro
               
               $result='<div class="alert alert-danger" role="alert">
               '.$nome.' ja cadastrado, tente outro! Voltar a pagina princial <a href="index.html" class="alert-link"> HOME</a>.
               </div>';
               
                 echo $result;
                    die();
                }
                else{
                //Inserindo no banco usando statement pdo
                $stmt = $pdo->prepare('INSERT INTO cadastro(nomeCadastro,telefoneCadastro,nascimentoCadastro,rgCadastro,cpfCadastro,senhaCadastro) VALUES(:nome,:telefone,:nascimento,:rg,:cpf,:senha)');
                $stmt->execute(array(':nome' => $nome, ':telefone' => $telefone, ':nascimento' => $nascimento, ':rg' => $rg, ':cpf' => $cpf, 'senha' => $senha));
                
                $result='<div class="alert alert-success"  role="alert">'.$nome.'
                cadastrado com sucesso! Voltar a pagina inicial<a href="index.html" class="alert-link"> HOME</a>.
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
    function lerCliente($nome,$telefone) //Metodo para SELECT do banco
    {
        $link = new linkBanco();
        $pdo = ($link->linkBanco());
        $consulta = $pdo->query('SELECT nomeCadastro,telefoneCadastro FROM cadastro;');
        
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            echo "<br />Nome: {$linha['nomeCadastro']} - Telefone: {$linha['telefoneCadastro']}<br />";
        }
        
    }
    function atualizarCliente($id,$nome) //Metodo para UPDATE no banco
    {
        try {
            $link = new linkBanco();
            $pdo = ($link->linkBanco());
            $stmt = $pdo->prepare('UPDATE cadastro SET nomeCadastro = :nome WHERE id = :id');
            $stmt->execute(array(':id'   => $id,':nome' => $nome));
          
            echo $stmt->rowCount();
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
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
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    }
    



