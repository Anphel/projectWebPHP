<?php

class linkBanco
{
    function linkBanco() {
        $user = 'root';//usuario do banco
        $pass = '';//senha do banco
        $pdo = new PDO('mysql:host=localhost;dbname=teste', $user, $pass);//objeto com PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        return $pdo;
    }
}

