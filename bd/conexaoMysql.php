<?php

/*********************************************************************

    Objetivo: arquivo para configurar a conexao com o Banco de Dados Mysql
    Data: 15/09/2021
    Autor: Jonatas Santos




**********************************************************************/


// Abre a conexão com a base de dados Mysql
function conexaoMysql()
{
    //importando o arquivo ../ - serve para sair de uma pasta e ir para outra
    
    //require_once('../functions/config.php');
    //declaração de variaveis para conexão com db
    
    $server = (string) BD_SERVER; //caminho do servidor
    $user = (string) BD_USER; 
    $password = (string) BD_PASSWORD ;
    $dataBase = (string) BD_DATABASE;
    
    // Cria uma variavel para receber o  valor do banco, fazer o if porque o mysql retorna true ou false
   if($conexao = mysqli_connect($server,$user,$password,$dataBase))  
      return $conexao;
    else
    {
        echo (ERRO_CONEXAO_BD);
        return false;
        
    }
        
    
    
      
    
    /*
        formas de criar a conexão com Banco de Dados
        
        mysql_connect();
        mysqli_connect();
        PDO();
        
        
        
    */
}






?>