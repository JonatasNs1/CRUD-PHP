<?php
    /******************************************************************************
    Objetivo: Buscar ou listar os dados de clientes solicitando ao banco de dados
    Data: 23/09/2021
    Autor: Jonatas Santos

    ****************************************************************************/

require_once(SRC . 'bd/listarClientes.php');

    function exibirClientes()
    {
        //chama a função que busca os dados no bd e recebe os registros de clientes
       $dados = listar();
        
        return $dados;
        
        
    }


?>