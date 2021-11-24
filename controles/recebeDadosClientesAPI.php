<?php
/*
    objetivo: Arquivo responsável por receber dados da API(post ou put)
    Data:24/11/2021
    Autor: Jonatas Santos
*/

//import do arquivo de configuração
require_once('../functions/config.php');

//import do arquivo que vai inserir no BD
require_once(SRC.'bd/inserirCliente.php');

function inserirClienteAPI($arrayDados) //função para inserir dados no Banco via Post da API
{
        // fazer tratamento de dados para consistencia, caixa vazia, tamanho de caracter etc...

    if(inserir($arrayDados)){ //recebo o array e chamo a função
        return true;
    }else{
        return false;
    }
       
    

}


?>