<?php
include_once("../conexao.php");

@session_start();

$idvisita = $_POST['id'];

$sql_local = "SELECT * from visitante where id = $idvisita";
$query_local = $pdo->query($sql_local) or die(/*"Erro: ".$pdo->errorInfo()*/);
$dados_local = $query_local->fetchAll(PDO::FETCH_ASSOC);

$usuario = $dados_local[0]['usuario'];
$responsavel = $dados_local[0]['morador'];
$status = $dados_local[0]['situacao'];

if($responsavel == $_SESSION['usuario'] || $_SESSION['nvl'] == 'admin'){
echo "
<div id='fundomodal'>   
        <div class='boxmodaleditar'>

    <form id='form' method='POST' enctype='multipart/form-data' style = 'margin:auto;'>

    <input type='hidden' id='idvisita' name='idvisita' value='$idvisita'>

        <h1>Edição de visitante</h1>
        <div class='card-content-cadastro'>

                <div class='card-content-area-cadastro'>

                    <label for='usuario'>Visitante</label>

                    <input type='text' id='usuario' name='usuario' autocomplete='off' value='$usuario' required>

                </div>

                <div class='card-content-area-cadastro'>

                    <label for='responsavel'>Responsavel</label>

                    <input type='text' id='responsavel' name='responsavel' autocomplete='off' value='$responsavel'>

                </div>

        </div>
        
        <h4>Status</h4>
        <div class='spr-input' style='display: flex;'>
                
                <label class='container'>Ativado
                    <input type='radio'"; if($status == "ativado"){ echo "checked='checked'"; } echo "name='status' id='status' value='ativado'>
                    <span class='checkmark'></span>
                </label>
                <label class='container'>Desativado
                    <input type='radio'";if($status == "desativado"){ echo "checked='checked'"; } echo "name='status' id='status' value='desativado'>
                    <span class='checkmark'></span>
                </label>
        </div>

        <div class='spr-input'>
                <h4>imagem</h4>
                <input type='file' class='spr-input' name='imagem' id='imagem' >
            </div>

        <button type='submit' class='spr-input atualizarcadastro' id=btn-atualizar'>Atualizar</button>
           </form>

         </div>
        <div id='backdrop'>
        </div>
</div>
        ";
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

<script type="text/javascript">
        
    $('#form').submit(function(){
        event.preventDefault();
        let formData = new FormData(this);

        $.ajax({
        url: "acoes/edicao/atualizarvisita.php",
            type: 'POST',
            data: formData,
            success: function(mensagem){

                if(mensagem == "item atualizado"){
                    
                   
                    location.reload();
                  toastr.success("Item atualizado")
                    $('#modal').html(mensagem)
                    

                }else if(mensagem == "Morador não cadastrado"){
                   
                    toastr.error("Morador não cadastrado");
                    $('#modal').html(mensagem)

                }else if (mensagem == "verifique os campos"){
                    toastr.error("Verifique os campos");
                    $('#modal').html(mensagem)
                }
                    },


        cache: false,
        contentType: false,
        processData: false,
        xhr: function() {  // Custom XMLHttpRequest
            var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                myXhr.upload.addEventListener('progress', function () {
                    /* faz alguma coisa durante o progresso do upload */
                }, false);
            }
        return myXhr;
        }
            });
        });

</script>
<?php }?>