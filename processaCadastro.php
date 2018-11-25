<?php
include ('Cliente.php');
//Cria o objeto da Classe Cliente
$perfil = new Cliente($_POST['nome'],$_POST['telefone'],$_POST['nascimento'],$_POST['rg'],$_POST['cpf'],$_POST['email'],MD5($_POST['senha']));
//Grava no banco usando o metodo do obj criado
$perfil->gravarCliente($_POST['nome'],$_POST['telefone'],$_POST['nascimento'],$_POST['rg'],$_POST['cpf'],$_POST['email'],MD5($_POST['senha']));