<?php
require_once("../../conexao.php");

session_start();

@$imagem = @$_FILES['imagem'];
$idvisita = $_POST['idvisita'];
$usuario = $_POST['usuario'];
$responsavel = $_POST['responsavel'];
$status = $_POST['status'];
if($responsavel == $_SESSION['usuario'] || $_SESSION['nvl'] == 'admin'){

if($responsavel !=""){
    $sql_morador = $pdo->query("SELECT * from cadastro where usuario = '$responsavel'");
    $dados_morador = $sql_morador->fetchAll(PDO::FETCH_ASSOC);
    $linhas_morador = count($dados_morador);
    if($linhas_morador == 0){
        echo 'Morador não cadastrado';
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
    


    
if($imagem["name"] != "" && isset($usuario) && isset($idvisita) && isset($responsavel) && isset($status)){

    if($_SESSION['nvl'] == 'admin'){
    $atualizarvisita = $pdo->prepare("UPDATE visitante set usuario = ?, morador = ?, situacao = ?, imagem = ? WHERE id = ?");
    
   $atualizarvisita->bindParam(1, $usuario,PDO::PARAM_STR);
   $atualizarvisita->bindParam(2, $responsavel,PDO::PARAM_STR);
   $atualizarvisita->bindParam(3, $status,PDO::PARAM_STR);
   $atualizarvisita->bindParam(4, $nomearquivo,PDO::PARAM_STR);
   $atualizarvisita->bindParam(5, $idvisita,PDO::PARAM_INT);
}else{
    $atualizarvisita = $pdo->prepare("UPDATE visitante set usuario = ?,  situacao = ?, imagem = ? WHERE id = ?");
    
   $atualizarvisita->bindParam(1, $usuario,PDO::PARAM_STR);
   $atualizarvisita->bindParam(2, $status,PDO::PARAM_STR);
   $atualizarvisita->bindParam(3, $nomearquivo,PDO::PARAM_STR);
   $atualizarvisita->bindParam(4, $idvisita,PDO::PARAM_INT);
}
   
   $atualizarvisita->execute();


   if($verificar == 1){
    move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho2);
    //move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho);
}   
   echo "item atualizado";

}else if(isset($usuario) && isset($idvisita) && isset($responsavel) && isset($status)){

    if($_SESSION['nvl'] == 'admin'){
    $atualizarvisita = $pdo->prepare("UPDATE visitante set usuario = ?, morador = ?, situacao = ? WHERE id = ?");
    
    $atualizarvisita->bindParam(1, $usuario,PDO::PARAM_STR);
    $atualizarvisita->bindParam(2, $responsavel,PDO::PARAM_STR);
    $atualizarvisita->bindParam(3, $status,PDO::PARAM_STR);
    $atualizarvisita->bindParam(4, $idvisita,PDO::PARAM_INT);
}else{
    $atualizarvisita = $pdo->prepare("UPDATE visitante set usuario = ?, situacao = ? WHERE id = ?");
    
    $atualizarvisita->bindParam(1, $usuario,PDO::PARAM_STR);
    $atualizarvisita->bindParam(2, $status,PDO::PARAM_STR);
    $atualizarvisita->bindParam(3, $idvisita,PDO::PARAM_INT);
}

    $atualizarvisita->execute();
    
echo "item atualizado";
}else {
    echo "verifique os campos";
}
}
?>