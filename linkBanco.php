<?php

class linkBanco
{
    function linkBanco() {
        $user = 'root';
        $pass = '';
        $pdo = new PDO('mysql:host=localhost;dbname=teste', $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  ;
        return $pdo;
    }
}

