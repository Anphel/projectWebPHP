<?php
include ('Cliente.php');
$perfil = new Cliente();
$perfil->enviar_senhaCliente($_POST['email']);