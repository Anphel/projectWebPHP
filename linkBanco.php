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

