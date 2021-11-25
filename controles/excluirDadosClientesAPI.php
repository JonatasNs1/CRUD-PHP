<?php

/*Objetivo: Arquivo responsável por receber o id do Cliente e excluir do BD */

require_once(SRC.'bd/excluirCliente.php');

function excluirClienteAPI($id) //função para atualizar dados no Banco via PUT da API
{

        // fazer tratamento de dados para consistencia, caixa vazia, tamanho de caracter etc...
    if(excluir($id)){ //recebo o array e chamo a função editar do arquivo atualizarCliente.php
         return true;
     
    }else{
        return false;
        
    }
       
    

}



?>