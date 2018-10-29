<?php
include ('Cliente.php');
$perfil = new Cliente($_POST['nomeLogin'],MD5($_POST['senhaLogin']));
$perfil->logarCliente($_POST['nomeLogin'], MD5($_POST['senhaLogin']));