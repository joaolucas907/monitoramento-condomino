<?php 
include_once("../../conexao.php");

@session_start();

if($_SESSION['nvl'] == 'admin'){
@$imagem = @$_FILES["imagem"];
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$senhanv = $_POST['senhanv'];
$tempo = $_POST['tempo'];


if($usuario!=""){
    $sql_visita = $pdo->query("SELECT * from cadastro where usuario = '$usuario'");  
    $dados_visita = $sql_visita->fetchAll(PDO::FETCH_ASSOC);
    $linhas_visita = count($dados_visita);
    if($linhas_visita > 0){
        echo 'Nome já Cadastrado';
        exit();
    }
}else{
    echo 'Coloque o nome do usuario';
    exit();
}

if($senha != $senhanv){
        echo 'senhas diferentes';
        exit();
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
                    } else {               
                        if($verificar == 1){
                            move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho2);
                            //move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho);
                        }
                    }
                }
            }
        }   
    } else{
        $nomearquivo = "imgpadrao.png";
    }
    

$res = $pdo->prepare("INSERT into cadastro (usuario, senha, imagem, tempo, nvl, monitoramento, situacao) values (?,?,?,?,'moradortemp','fora','ativado')");

$res->bindParam(1, $usuario,PDO::PARAM_STR);
$res->bindParam(2, $senha,PDO::PARAM_STR);
$res->bindParam(3, $nomearquivo,PDO::PARAM_STR);
$res->bindParam(4, $tempo,PDO::PARAM_STR);


$res->execute();
echo "Cadastrado com Sucesso!!";

}?>