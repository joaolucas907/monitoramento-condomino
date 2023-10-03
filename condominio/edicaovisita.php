<?php
include_once("cabecalho.php");
include_once("conexao.php")
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Edição</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Visitantes</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Nº Cadastro</th>
                                            <th>Foto</th>
                                            <th>Nome</th>
                                            <th>Morador responsavel</th>
                                            <th>Situação</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nº Cadastro</th>
                                            <th>Foto</th>
                                            <th>Nome</th>
                                            <th>Morador responsavel</th>
                                            <th>Situação</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                            <?php
                                $sql_visitante = "SELECT * FROM visitante";         
                                $query_visitante = $pdo->query($sql_visitante) or die("Erro: ".$pdo->errorInfo());
                                $dados_visitante = $query_visitante->fetchAll(PDO::FETCH_ASSOC);
                                for($i = 0; $i < count($dados_visitante); $i++){
                                    foreach($dados_visitante[$i] as $key => $value) { }
                                        
                                            $id = $dados_visitante[$i]['id'];
                                            $usuario = $dados_visitante[$i]['usuario'];
                                            $imgnome = $dados_visitante[$i]['imagem'];
                                            $morador = $dados_visitante[$i]['morador'];
                                            $monitoramento = $dados_visitante[$i]['monitoramento'];
                                            $situacao = $dados_visitante[$i]['situacao'];

                                            if($morador == $_SESSION['usuario'] || $_SESSION['nvl'] == 'admin'){
                                ?>          
                                            
                                            <tr>
                                                    <td><a href="#"><div onclick="abrirmodal('<?=$id?>')"><?=$id?></a></td>
                                                    <td><a href="#"><div onclick="abrirmodal('<?=$id?>')"><img src="imagens/<?=$imgnome?>" class="imagem"></a></td>
                                                    <td><a href="#"><div onclick="abrirmodal('<?=$id?>')"><?=$usuario?></a></td>
                                                    <td><a href="#"><div onclick="abrirmodal('<?=$id?>')"><?=$morador?></a></td>
                                                    <td><a href="#"><div onclick="abrirmodal('<?=$id?>')" class="<?=$situacao?>"><?=$situacao?></a></td>
                                            </tr>
                                               
                                            
                        <?php               
                                                  }      }


?>          
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>

<script>

function abrirmodal(id){
    $.ajax({
                url: "modal/modaleditarvisita.php",
                method: "post",
                data: {id},
                dataType: "html",
                success: function(result){

                    $('#modal').html(result)

                },
                
            })
    }

</script>