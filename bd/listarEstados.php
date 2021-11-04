<?php

    // 2 arquivo ser feito
    /********************************************************************************
        Objetivo: Listar os dados de estados do banco de dados 
        data:23/09/2021
        Autor: Jonatas Santos

    **************************************************************************/

// import do arquivo de conexão com o bd
require_once(SRC.'bd/conexaoMysql.php');

    //retorna todos os registros existentes no banco
    function listarEstados()
    {
        $sql = "select * from tblEstado order by nome";
        
        
         //abre a conexão com o banco de dados
    $conexao = conexaoMysql();

    // solicita ao banco de dados a execução do script SQL
        //criando uma variavel para receber os dados do bd
   $select =  mysqli_query($conexao, $sql);
    
    return $select;
        
        
        
    }



?>