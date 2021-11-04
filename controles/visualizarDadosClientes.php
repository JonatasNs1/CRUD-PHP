<?php

     /*****************************************************************************
        3 - passo para fazer a modal
     
        Objetivo: Arquivo responsavel por buscar um registro para exibir na modal do visualizar
        Data: 21/10/2021
        Autor: Jonatas Santos
    
    ******************************************************************************/

        function visualizarCliente($id){
            
            require_once('functions/config.php');
            

            require_once(SRC .'bd/listarClientes.php');


            $idCliente = $id;


            $dadosCliente = buscar($idCliente);
            
            if($rsCliente=mysqli_fetch_assoc($dadosCliente))
            {
                return $rsCliente;
            }else{
                return false;
            }
            
            
            
        }




?>