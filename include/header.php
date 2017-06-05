<?php

//Include Conexao BD PDO
include_once ("../classe/Database.php");
//Include Conexao BD OLD
include_once '../classe/conexao.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <!--Titulo Pagina-->
        <title>CRUD - loginSession</title>

        <!--CSS-->
        <link href="../style/style.css" rel="stylesheet" type="text/css">

        <!-- Incluindo o CSS do Bootstrap -->
        <link href="../style/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../style/css/dataTables.bootstrap.min.css" rel="stylesheet" media="screen"> 

        <!--META TAGs-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Incluindo o jQuery DataTable -->
        <script src="../style/js/dataTables.bootstrap.min.js"></script>
        <script src="../style/js/jquery-1.12.3.js"></script>
        <script src="../style/js/jquery.dataTables.min.js"></script>
        
<!--         Incluindo o jQuery que é requisito do JavaScript do Bootstrap 
        <script src="http://code.jquery.com/jquery-latest.js"></script>-->

        <!-- Incluindo o JavaScript do Bootstrap -->
        <script src="../style/js/bootstrap.min.js"></script>
        
<!--    Chamadas externas de CSS e JS -->
<!--        <script src="//code.jquery.com/jquery-1.12.3.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>-->
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<!--        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">-->
        
        <script>
            $(document).ready(function () {
                $('#formdt').DataTable(
                {
                    "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate":{
                                "sNext": "Próximo",
                                "sPrevious": "Anterior",
                                "sFirst": "Primeiro",
                                "sLast": "Último"
                                },
                    "oAria": {
                            "sSortAscending": ": Ordenar colunas de forma ascendente",
                            "sSortDescending": ": Ordenar colunas de forma descendente"
                            }
                    }
                   
                }
                );
            });
        </script>
        
    </head>
    <body>
                
    
        