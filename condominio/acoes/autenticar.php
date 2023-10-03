<?php
require_once("../conexao.php");
 
    @session_start();

$usuario = $_POST['nome'];
$senha = $_POST['senha'];


if(isset($usuario) && isset($senha)){
    $sql_teste = $pdo->query("SELECT * from cadastro where usuario = '$usuario'");  
        if($sql_teste->rowCount() == 0){
            echo 'usuario não Cadastrado';
            exit();
        }

$sql_login = $pdo->prepare("SELECT * from cadastro WHERE usuario = ? AND senha = ?");
$sql_login->bindValue(1, $usuario);
$sql_login->bindValue(2, $senha);
$sql_login->execute();
$logar = $sql_login->fetchAll(PDO::FETCH_ASSOC);
        if($sql_login->rowCount() == 0){
            echo 'Senha Incorreta';
            exit();
        }else {
            
            $_SESSION['usuario'] = $logar[0]['usuario'];
            $_SESSION['nvl'] = $logar[0]['nvl'];
            echo 'Login com Sucesso!!';
        }
}else{
    echo"verifique os campos novamente";
}
?>