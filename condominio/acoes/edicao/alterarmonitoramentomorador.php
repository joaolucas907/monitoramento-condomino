<?php 
include_once('../../conexao.php');
session_start();

if($_SESSION['nvl'] == 'admin'){

$idmorador = $_POST['id'];
$monitoramento = $_POST['monitoramento'];

if($monitoramento == 'fora'){
$alterar = 'dentro';
}else if($monitoramento == 'dentro'){
$alterar = 'fora';
}

$res = $pdo->prepare("UPDATE cadastro set monitoramento = ? where id = ?");

$res->bindParam(1, $alterar,PDO::PARAM_STR);
$res->bindParam(2, $idmorador,PDO::PARAM_INT);

$res->execute();

echo 'monitoramento modificado';
}
?>