<?php
    /*****************************************************************************
        Objetivo: Arquivo responsavel por receber o id do cliente e  encaminhar para a função que irá buscar os dados
        Data: 06/10/2021
        Autor: Jonatas Santos
    
    ******************************************************************************/

// 3- passo import do arquivo configuração de variaveis e constantes
require_once('../functions/config.php');
//4 passo - import do arquivo para excluir no banco de dados

require_once(SRC .'bd/listarClientes.php');

//primeiro passo para excluir os dados
//o id esta sendo encaminhado pela index, no link que realizado na imagem do excluir
$idCliente = $_GET['id'];
// 2 passo - echo ($idCliente);

$dadosCliente = buscar($idCliente); // tirando a função de dentro do if e colocando em uma variavel, chama a funcao para buscar o id do cliente
//5 passo- chamando a função para buscar e encaminha o id que será localizado no bd
if($rsCliente=mysqli_fetch_assoc($dadosCliente)){
   // session_start();- Ativa a utilização de variaveis de sessão, (são variaveis) globais
    session_start();
    
    //'cliente' - é nome da variavel, criamos uma variavel de seção oara guardar o array com os dados do cliente que retornou do bd
    $_SESSION['cliente'] = $rsCliente;
    
    //header é como se fosse o href, chamando o index
    //permitte chamar um arquivo como se fosse um link, atraves do php
    header('location:../index.php');
}else{
    echo ("
            <script>
              alert('". BD_MSG_ERRO ."');
             window.history.back();
             </script>
        ");
}



?>++