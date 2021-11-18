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

    //Função para criar um array de dados com base no retorno do Banco de dados
    function criarArray($objeto)
    {
        $cont = (int) 0;//contador

        //Estrutura de repetição para pegar um objeto de dados e converter em um array
        while($rsDados = mysqli_fetch_assoc($objeto))
        {
             //objeto array
            $arrayDados[$cont] = array( 
                "id" => $rsDados['idcliente'],
                "nome" => $rsDados['nome'],
                "rg" => $rsDados['rg'],
                "cpf" => $rsDados['cpf'],
                "telefone" => $rsDados['telefone'],
                "celular" => $rsDados['celular'],
                "email" => $rsDados['email'],
                "obs" => $rsDados['obs'],
                "foto" => $rsDados['foto'],
                "idEstado" => $rsDados['idEstado'],
                "sigla" => $rsDados['sigla']
            );

            $cont +=1; //contador
        }
        //Depois tem que dar o return, pode acontecer de alguem solicitar essa busca no banco e o banco pode estar vazio, ai ele não vai entrar no while
        if(isset($arrayDados)){ // Tratamento para validar se existe dados no banco, se não houver o retorno deverá ser false
            return $arrayDados;
        }else{
            return false;
        }
    }

    //Função para gerar um JSON, com base em um array de dados
    function criarJSON($arrayDados)
    {
        //especifica no cabeçalho do php que será gerado um JSON
        header("content-type:application/json");//cabeçalho dos dados que vão ser gerado, do php

        $listJSON = json_encode($arrayDados); // converte um array em Json

        /*
            json_encode() - converte um array em formato JSON
            json_decode() - converte um JSON em formato array
        */

        if(isset($listJSON)){
            return $listJSON;
         }else{
             return false;
        }
    }


?>