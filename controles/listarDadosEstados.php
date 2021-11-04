<?php
    
    // 1 arquivo a ser feito
     /******************************************************************************
    Objetivo: Criando um arquivo listarEstados, listar os dados de estados no banco de dados
    Data: 27/10/2021
    Autor: Jonatas Santos

    ****************************************************************************/

require_once(SRC . 'bd/listarEstados.php');

    function exibirEstados()
    {
        //chama a função que busca os dados no bd e recebe os registros de estados
       $dados = listarEstados();
        
        return $dados;
        
        
    }


?>