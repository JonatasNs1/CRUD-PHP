<?php

   /*****************************************************************************
        Objetivo: Arquivo responsavel por receber o id do Cliente e encaminhar para a função que irá excluir o dado
        Data: 29/09/2021
        Autor: Jonatas Santos
    
    ******************************************************************************/

// 3- passo import do arquivo configuração de variaveis e constantes
require_once('../functions/config.php');
//4 passo - import do arquivo para excluir no banco de dados
require_once(SRC .'bd/excluirCliente.php');

//primeiro passo para excluir os dados
//o id esta sendo encaminhado pela index, no link que realizado na imagem do excluir
$idCliente = $_GET['id'];
// 2 passo - echo ($idCliente);

//5 passo- chamando a função para excluir e encaminha o id que será removido do banco de dados, dps cria um if
if(excluir($idCliente)){
   echo(BD_MSG_EXCLUIR);
}else{
    echo ("
            <script>
              alert('". BD_MSG_ERRO ."');
             window.history.back();
             </script>
        ");
}


?>