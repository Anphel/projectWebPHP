<link href="../css/style.css" rel="stylessheet" type="text/css" >
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

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
    public function __construct($nome,$telefone,$nascimento,$rg,$cpf,$senha)
    {
        //Metodo construtor
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->nascimento = $nascimento;
        $this->rg = $rg;
        $this->cpf = $cpf;
        $this->senha = $senha;
    }
    function __destruct()
    {
      //Metodo destrutor
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
                
                $result='<div class="alert alert-success" role="alert">'.$nome.'
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
        $consulta = $pdo->query("SELECT nomeCadastro,telefoneCadastro FROM cadastro;");
        
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


