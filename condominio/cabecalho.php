<?php
session_start();
$nome = $_SESSION['usuario'];
if(isset($nome)){

include_once("conexao.php");

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Hotel ...</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />

        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/cadastro.css" rel="stylesheet" />
        <link href="css/modal.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/monitoramento.css">


        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Condominio ...</a>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <?php if($_SESSION['nvl'] == 'admin'){?>
                            <div class="sb-sidenav-menu-heading">MONITORAMENTO</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Moradores
                            </a>  
                            <a class="nav-link" href="monitorarvisita.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Visitantes
                            </a> <?php }?>                           
                            <div class="sb-sidenav-menu-heading">EDIÇÂO</div>
                            <?php if($_SESSION['nvl'] == 'admin'){?>
                            <a class="nav-link" href="edicaousuario.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Moradores
                            </a> <?php }?>
                            <a class="nav-link" href="edicaovisita.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Visitantes
                            </a>

                            <div class="sb-sidenav-menu-heading">CADASTRO</div>
                            <?php if($_SESSION['nvl'] == 'admin'){?>
                            <a class="nav-link" href="criaradmin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Administrador
                            </a>
                            <a class="nav-link" href="criarmorador.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Morador
                            </a>
                            <a class="nav-link" href="criarmoradortemp.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Morador temporario
                            </a> <?php }?>
                            <a class="nav-link" href="criarvisitante.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Visitante
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?=$_SESSION['usuario']?>
                    </div>
                </nav>
            </div>
            <div id="modal"></div>

            <?php }else{?>
                <script>
                     window.location.replace("login.php");
                </script>
            <?php }?>