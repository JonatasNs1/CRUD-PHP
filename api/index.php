<?php

    //  Permissões e configurações para a API responder em um servidor real
    header('Access-Control-Allow-Origin: *'); //para ela ter permissão para consumir no js
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS'); //quais são os métodos que sua api vai responder
    header('Access-Control-Allow-Header: Content-Type');
    header('Content-Type: application/json');

    //import do arquivo de configuração do sistema
     require_once("../functions/config.php");

    $url = (string) null;

    //explode - cria um array com base na URL até a pasta API, guarda no indice 0 a primeira palavra após a barra
    $url = explode('/',$_GET['url']); // parametro ele vai pegar a escrita da url, e vai dividir o que é caminho e o que é estrutura de diretório

        //estrutura condicional para encaminhar a api conforme a escolha[cliente ou estados]
    switch($url[0]){
        case 'clientes':
                //import do arquivo de api de clientes, 1 passo
                 require_once('clientesApi/index.php');
                 break;
         case 'estados':
                //import do arquivo de api de clientes, 1 passo
                require_once('estadosApi/index.php');
                break;        
    }

    
    


?>