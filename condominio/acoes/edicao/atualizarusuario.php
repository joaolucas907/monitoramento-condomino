<?php
require_once("../../conexao.php");

session_start();

@$imagem = @$_FILES['imagem'];
@$tempo = @$_POST['tempo'];
$idusuario = $_POST['idusuario'];
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$status = $_POST['status'];
if($_SESSION['nvl'] == 'admin'){

    if($tempo!=""){
        if(mb_strlen($tempo)<10){
            echo 'data invalido';
            exit();
        }
    }

if($imagem["name"] != ""){
    /*
        ini_set('display_errors',1); echo "<br>";
        ini_set('display_startup_erros',1); echo "<br>";
        error_reporting(E_ALL);echo "<br>";
           */

            $verificar = 1;
            $nomeimagem = $imagem["name"];
            $novonomeimagem = uniqid();
            $extensao = strtolower(pathinfo($nomeimagem, PATHINFO_EXTENSION));
            $nomearquivo = $novonomeimagem.".".$extensao;
            $caminho = "../../imagens/".$nomearquivo;
            $caminho2 = "/var/www/html/imagens/".$nomearquivo;
            if($extensao != 'png' && $extensao != 'jpeg' & $extensao != 'jpg' && $extensao != 'gif'){
                $verificar=0; die("arquivo não é uma extensão aceita: png, jpg, jpeg, gif");
            } else{
                if (getimagesize($imagem["tmp_name"]) === false) {
                    $verificar=0; die("arquivo $nomeimagem não é uma imagem");
                } else {
                    if ($imagem['size']>5200000) {
                        $verificar=0; die("Arquivo maior que 5MB, favor diminuir tamanho");
                } else {
                    if ($imagem['erro']>0) {
                        die("Falha ao enviar arquivo");
                    } 
                    }
                }
            }
        }   
    


    
if($imagem["name"] != "" && isset($usuario) && isset($idusuario) && isset($senha) && isset($status) && isset($tempo)){

     $atualizarvisita = $pdo->prepare("UPDATE cadastro set usuario = ?, senha = ?, situacao = ?, imagem = ?, tempo = ? WHERE id = ?");
            
    $atualizarvisita->bindParam(1, $usuario,PDO::PARAM_STR);
    $atualizarvisita->bindParam(2, $senha,PDO::PARAM_STR);
    $atualizarvisita->bindParam(3, $status,PDO::PARAM_STR);
    $atualizarvisita->bindParam(4, $nomearquivo,PDO::PARAM_STR);
    $atualizarvisita->bindParam(5, $tempo,PDO::PARAM_STR);
    $atualizarvisita->bindParam(6, $idusuario,PDO::PARAM_INT);
           
    $atualizarvisita->execute();
        
        
    if($verificar == 1){
    move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho2);
    //move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho);
}   
    echo "item atualizado";
        
}else if(isset($usuario) && isset($idusuario) && isset($senha) && isset($status) && isset($tempo)){
        
    $atualizarvisita = $pdo->prepare("UPDATE cadastro set usuario = ?, senha = ?, situacao = ?, tempo = ? WHERE id = ?");
            
    $atualizarvisita->bindParam(1, $usuario,PDO::PARAM_STR);
    $atualizarvisita->bindParam(2, $senha,PDO::PARAM_STR);
    $atualizarvisita->bindParam(3, $status,PDO::PARAM_STR);
    $atualizarvisita->bindParam(4, $tempo,PDO::PARAM_STR);
    $atualizarvisita->bindParam(5, $idusuario,PDO::PARAM_INT);
        
    $atualizarvisita->execute();
            
echo "item atualizado";

}else if($imagem["name"] != "" && isset($usuario) && isset($idusuario) && isset($senha) && isset($status)){

    $atualizarvisita = $pdo->prepare("UPDATE cadastro set usuario = ?, senha = ?, situacao = ?, imagem = ? WHERE id = ?");
    
   $atualizarvisita->bindParam(1, $usuario,PDO::PARAM_STR);
   $atualizarvisita->bindParam(2, $senha,PDO::PARAM_STR);
   $atualizarvisita->bindParam(3, $status,PDO::PARAM_STR);
   $atualizarvisita->bindParam(4, $nomearquivo,PDO::PARAM_STR);
   $atualizarvisita->bindParam(5, $idusuario,PDO::PARAM_INT);
   
   $atualizarvisita->execute();


   if($verificar == 1){
    move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho2);
    //move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho);
}   
   echo "item atualizado";

}else if(isset($usuario) && isset($idusuario) && isset($senha) && isset($status)){

    $atualizarvisita = $pdo->prepare("UPDATE cadastro set usuario = ?, senha = ?, situacao = ? WHERE id = ?");
    
    $atualizarvisita->bindParam(1, $usuario,PDO::PARAM_STR);
    $atualizarvisita->bindParam(2, $senha,PDO::PARAM_STR);
    $atualizarvisita->bindParam(3, $status,PDO::PARAM_STR);
    $atualizarvisita->bindParam(4, $idusuario,PDO::PARAM_INT);

    $atualizarvisita->execute();
    
echo "item atualizado";

}else {
    echo "verifique os campos";
}
}
?>