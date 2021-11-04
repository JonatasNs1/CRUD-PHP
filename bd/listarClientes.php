<?php
    /********************************************************************************
        Objetivo: Listar na tela todos os dados de Clientes do Banco de dados 
        data:23/09/2021
        Autor: Jonatas Santos

    **************************************************************************/

// import do arquivo de conexão com o bd
require_once(SRC.'bd/conexaoMysql.php');

    //retorna todos os registros existentes no banco
    function listar()
    {
        $sql = "select * from tblcliente order by idcliente desc";
        
        
         //abre a conexão com o banco de dados
    $conexao = conexaoMysql();

    // solicita ao banco de dados a execução do script SQL
        //criando uma variavel para receber os dados do bd
   $select =  mysqli_query($conexao, $sql);
    
    return $select;
        
        
        
    }


    // retorna apenas um registro, com base no id - serve para o editar, where buscando o id do cliente(chave primaria) comando do banco para voce fazer um filtro(onde), argumento da função é um critério de busca($idCliente)
    function buscar($idCliente)
    {
        //script
        $sql = "select tblcliente.*, tblEstado.sigla
                from tblcliente
	               inner join tblEstado
                    on tblEstado.idEstado = tblcliente.idEstado
                where tblcliente.idcliente = ".$idCliente; //9 passo, arrumar o select, retorna a sigla do estado
        
        
         //abre a conexão com o banco de dados
    $conexao = conexaoMysql();

    // solicita ao banco de dados a execução do script SQL
        //criando uma variavel para receber os dados do bd
   $select =  mysqli_query($conexao, $sql);
    
    return $select;
        
    }
   
?>