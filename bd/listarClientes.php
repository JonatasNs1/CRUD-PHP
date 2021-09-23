<?php
    /********************************************************************************
        Objetivo: Listar todos os dados de Clientes do Banco de dados 
        data:23/09/2021
        Autor: Jonatas Santos

    **************************************************************************/

// import do arquivo de conexão com o bd
require_once('bd/conexaoMysql.php');

    function listar()
    {
        $sql = "select * from tblcliente order by idcliente desc";
        
        
         //abre a conexão com o banco de dados
    $conexao = conexaoMysql();

    // solicita ao banco de dados a execução do script SQL
        //criando uma variavel para receber os dados do bd
   $select =  mysqli_query($conexao, $sql);
    
    return $select;
        
        
        
    }

   
?>