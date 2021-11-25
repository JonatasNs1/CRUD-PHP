<?php
    
   /*****************************************************************************
        Objetivo: Excluir dados de Cliente no Banco de dados
        Data: 29/09/2021
        Autor: Jonatas Santos
    
    ******************************************************************************/

//3 passo- import do arquivo conexão com o banco de dados
require_once('../bd/conexaoMysql.php');
    function excluir($idCliente) // 1 passo - criar uma função que recebe como parametro idCliente
    {
        $sql = "delete from tblcliente
                where idcliente =".$idCliente; //2 passo - script do delete
            
        //4 passo - chamando a funcao que estabelece a conexão com o banco de dados
        $conexao = conexaoMysql(); 
        
        
        // 5 passo- quem é o banco de dados, quem é o script q vai mandar pro banco de dados - mysqli_query só retorna verdadeiro e falso
       if(mysqli_query($conexao, $sql))
            if(mysqli_affected_rows($conexao))
                return true;
            else
                return false;
       else
           return false;
       
    }
?>