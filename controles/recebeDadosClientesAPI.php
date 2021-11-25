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
require_once(SRC.'bd/atualizarCliente.php');


function inserirClienteAPI($arrayDados) //função para inserir dados no Banco via Post da API
{
        // fazer tratamento de dados para consistencia, caixa vazia, tamanho de caracter etc...

    if(inserir($arrayDados)){ //recebo o array e chamo a função
        return true;
    }else{
        return false;
    }
       
    

}


function atualizarClienteAPI($arrayDados, $id) //função para atualizar dados no Banco via PUT da API
{

    //Cria um novo array apenas com o id
    $novoItem = array("id" => $id); // criando um novo array para somar com o outro array de dados

    //Acrescenta o array do novoItem do arrayDados, fazendo uma mescla de chaves
    $arrayCliente = $arrayDados + $novoItem;//somando o array novo com  o outro array, pega o item que ta novoItem e joga ele la no final do arrayDados

        // fazer tratamento de dados para consistencia, caixa vazia, tamanho de caracter etc...
    if(editar($arrayCliente)){ //recebo o array e chamo a função editar do arquivo atualizarCliente.php
        return true;
    }else{
        return false;
    }
       
    

}


// function excluirClienteAPI($id) //função para atualizar dados no Banco via PUT da API
// {

//         // fazer tratamento de dados para consistencia, caixa vazia, tamanho de caracter etc...
//     if(excluir($id)){ //recebo o array e chamo a função editar do arquivo atualizarCliente.php
//          return true;
     
//     }else{
//         return false;
        
//     }
       
    

// }


?>