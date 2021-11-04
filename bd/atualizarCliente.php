<?php 


    /*****************************************************************************
        Objetivo: Atualizar dados de um cliente existente no Banco de Dados 
        Data: 13/10/2021
        Autor: Jonatas Santos
    
    ******************************************************************************/

//import do arquivo conexão com o banco de dados
require_once('../bd/conexaoMysql.php');

//update do cliente, 9 passo do tblEstado acrescenta o idEstado
function editar($arrayCliente)
{
    $sql = "update tblcliente set 
            nome = '".$arrayCliente['nome']."',
            rg = '".$arrayCliente['rg']."',
            cpf = '".$arrayCliente['cpf']."',
            telefone = '".$arrayCliente['telefone']."',
            celular= '".$arrayCliente['celular']."',
            email = '".$arrayCliente['email']."',
            obs = '".$arrayCliente['obs']."',
             idEstado = ".$arrayCliente['idEstado']."
    
        where idcliente = ".$arrayCliente['id'];
    
      
        //chamando a funcao que estabelece a conexão com o banco de dados
        $conexao = conexaoMysql();
        //echo ($sql);
        // envia o script SQL para o BD
        
    //mysqli_query -> funcao responsavel para levar os scripts para o bd
       if(mysqli_query($conexao, $sql)) 
           return true; //Retorna verdadeiro se o registro for inserido no Banco de Dados
        else
            return false; //Retorna falso se houver algum problema
}

?>