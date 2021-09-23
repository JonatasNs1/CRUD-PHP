<?php 


    /*****************************************************************************
        Objetivo: Inserir dados de Clientes no Banco de Dados 
        Data: 16/09/2021
        Autor: Jonatas Santos
    
    ******************************************************************************/

//import do arquivo conexão com o banco de dados
require_once('../bd/conexaoMysql.php');

    function inserir($arrayCliente)
    {
        
        $sql = "insert into tblcliente
            (
            nome,
            rg,
            cpf,
            telefone,
            celular,
            email,
            obs
            
            ) 
            values
            (
                '".$arrayCliente['nome']."',
                '".$arrayCliente['rg']."',
                '".$arrayCliente['cpf']."',
                '".$arrayCliente['telefone']."', 
                '".$arrayCliente['celular']."',
                '".$arrayCliente['email']."',
                '".$arrayCliente['obs']."'
            )
            ";
       
        //chamando a funcao que estabelece a conexão com o banco de dados
        $conexao = conexaoMysql();
        
//        echo ($sql);
        // envia o script SQL para o BD
        
    //mysqli_query -> funcao responsavel para levar os scripts para o bd
       if(mysqli_query($conexao, $sql)) 
           return true; //Retorna verdadeiro se o registro for inserido no Banco de Dados
        else
            return false; //Retorna falso se houver algum problema
    }
   


?>