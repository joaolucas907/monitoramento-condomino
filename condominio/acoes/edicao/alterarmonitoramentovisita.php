<?php 
include_once('../../conexao.php');
session_start();

if($_SESSION['nvl'] == 'admin'){

$idvisita = $_POST['id'];
$monitoramento = $_POST['monitoramento'];

if($monitoramento == 'fora'){
$alterar = 'dentro';
}else if($monitoramento == 'dentro'){
$alterar = 'fora';
}

$res = $pdo->prepare("UPDATE visitante set monitoramento = ? where id = ?");

$res->bindParam(1, $alterar,PDO::PARAM_STR);
$res->bindParam(2, $idvisita,PDO::PARAM_INT);

$res->execute();

echo 'monitoramento modificado';
}
?>