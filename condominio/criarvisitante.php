<?php 
@session_start();/*
if(isset($_SESSION['nome'])){
*/

include_once("cabecalho.php");
include_once("conexao.php");
?>
    <body>
        
       
        <div class="spr-cabecalho" style = "margin-top:20px">
        <form id="form" method="POST" enctype="multipart/form-data">

                <h1 class="mt-4">Cadastro</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Visitante</li>
                        </ol>
                <div class="card-content-cadastro">

                        <div class="card-content-area-cadastro">

                            <label for="usuario">Usuario</label>

                            <input type="text" id="usuario" name="usuario" autocomplete="off" required>

                        </div>

                        <div class="card-content-area-cadastro">

                            <label for="morador">Morador responsavel</label>

                            <input type="text" id="morador" name="morador" autocomplete="off" value="<?=$_SESSION['usuario']?>" required>

                        </div>

                </div>

            <div class="spr-input">
                <h4>Foto</h4>
                <input type="file" class="spr-input" name="imagem" id="imagem" >
            </div>

            <button type="submit" value="enviar" class="spr-input adicionarcadastro" id="btn-cadastro">enviar</button>
            
        </form>

        <div align="center" id="mensagem" class="">

		</div>
</div>
    
        
    </body>
</html>


<!--AJAX PARA INSERÇÃO DOS DADOS COM IMAGEM -->
<script type="text/javascript">
        
    $('#form').submit(function(){
        event.preventDefault();
        var formData = new FormData(this);

    $.ajax({
       url: "acoes/cadastro/visita.php",
        type: 'POST',
        data: formData,

        success: function(mensagem){

                    $('#mensagem').removeClass()

                    if(mensagem == 'Cadastrado com Sucesso!!'){

                        $('#usuario').val('')
                        $('#morador').val('')
                        $('#imagem').val('')

                    }else{
                        
                       
                    }
                    $('#mensagem').text(mensagem)
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>

        <?php /* }else{?>
                <script>
                     window.location.replace("index.php");
                </script>
        <?php }*/?>