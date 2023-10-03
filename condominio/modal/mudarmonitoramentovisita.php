<?php 
session_start();

if($_SESSION['nvl'] == 'admin'){
include_once("../conexao.php");
$idvisita = $_POST['id'];
$sql_visitante = "SELECT * FROM visitante where id = $idvisita";         
$query_visitante = $pdo->query($sql_visitante) or die("Erro: ".$pdo->errorInfo());
$dados_visitante = $query_visitante->fetchAll(PDO::FETCH_ASSOC);

$visita = $dados_visitante[0]['usuario'];
$monitoramento = $dados_visitante[0]['monitoramento'];


echo '
<div id="fundomodal">   

    <div class="modalconfirmar" style="width: 323px; height: 152px;">
        <div class="modal-content">
            <div id="modal_confirm_header" class="modal-header alert-danger text-danger">
                <h5 class="modal-title" style="color: #842029; font-family: Segoe UI,Arial,sans-serif; font-weight: 400;margin-top: 0;font-weight: 500;">
                Aviso</h5>

            </div>
            <div id="modal_confirm_body" class="modal-body">
                <p>Deseja alterar o status de monitoramento do visitante '.$visita.'</p>
            </div>
            <div id="div_actions" class="modal-footer">
                <button data-action="1" type="button" class="btn btn-danger" onclick="fecharmodal()" style="color: #fff; background-color: #dc3545; border-color: #dc3545;">Voltar</button>
                <button data-action="1" type="button" class="btn btn-danger" onclick="confirmar('.$idvisita.', `'.$monitoramento.'`)" style="color: #fff; background-color: #3545dc; border-color: #3545dc;">Confirmar</button>    
            </div>
        </div>
    </div>
    <div id="backdrop">
    </div>
</div>
    ';
?> 

<script>
var backdrop = document.getElementById("backdrop");
var remove = document.getElementById("fundomodal");
backdrop.addEventListener("click", () => {
    fecharmodal();
});
function fecharmodal(){
    backdrop.parentNode.removeChild(backdrop);
    remove.parentNode.removeChild(remove);
}
</script>

<script >
function confirmar(id, monitoramento){
       
    event.preventDefault();
            
            $.ajax({
                url: "acoes/edicao/alterarmonitoramentovisita.php",
                method: "post",
                data: {id, monitoramento},
                dataType: "html",
                success: function(result){

                    if(result=='monitoramento modificado'){
                        location.reload();
                    }

                },
                
            })
        }
    
</script>
<?php }?>