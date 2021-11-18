<?php

// echo("testando a API"); primeiro passo, para testar
// die;
//import para start do slim php, 2 passo
    require_once("vendor/autoload.php");
  
    //import do arquivo de configuração do sistema, 3 passo
    //  require_once("../functions/config.php");
   require_once('../controles/exibirDadosClientes.php'); //9 passo, import do arquivo que solicita das requisições de busca do BD

    //slim configurado em orientação a objeto
       //Intancia da classe Slim\app, 
       //é realizada para termos acesso aos metodos da classe 
    $app = new \Slim\App(); // 4 passo

    //EndPoint - é um ponto de parada da API, ou seja serão as formas de requisição que a API irá responder, todos tem que dar um retorno
    // -> para acessar metodos da classe
    // significa que alguem está solicitando dados de clientes
    // request - será usado para pegar algo que vai ser enviado para pegar API(recebe), parametros da api
    // response - será utilizado para quando a API irá devolver algo, seja uma mensagem, status, body, header, etc (devolve)
    // args - será os argumentos que podem ser encaminhados para a API, parametros são variaveis que são criadas na api
    $app->get('/clientes', function($request, $response, $args){ // 5 passo, Endpoint: GET, retorna todos dados de clientes
       
        // 10 passo, chama a função(Na pasta controles) que vai requisitar os dados no Banco de Dados
        if($listDados = exibirClientes()){
            //var_dump($listDados); teste para ver se foi 
            //die;
                if( $listDadosArray = criarArray($listDados)){  // criar um array para os dados que estão chegando
                         $listDadosJSON = criarJSON($listDadosArray);
                }
        } 
       
        return $response   ->withStatus(200) // qual é o status que eu vou devolver desse EndPoint, response é como se fosse o echo() //6 passo
                           ->withHeader('Content-Type', 'application/json') //como minha api vai responder quando alguem solicitar, especificar quqal é o tipo de cabeçalho que vai ser mandado para o body //7 passo
                           ->write($listDadosJSON); //Menssagem na tela 8 passo
    });

    $app->post('/clientes', function($request, $response, $args){ //Endpoint: POST, envia um novo cliente para o BD

        return $response   ->withStatus(201)
                           ->withHeader('Content-Type', 'application/json')
                           ->write('{"message":"Item criado com sucesso"}');
    });

    $app->put('/clientes', function($request, $response, $args){ //Endpoint: PUT, atualiza um cliente no BD

        return $response   ->withStatus(201) 
                           ->withHeader('Content-Type', 'application/json') 
                           ->write('{"message":"Item Atualizado com sucesso"}'); 
    });

    $app->delete('/clientes', function($request, $response, $args){ //Endpoint:DELETE, exclui um cliente no BD

        return $response   ->withStatus(200) 
                           ->withHeader('Content-Type', 'application/json')
                           ->write('{"message":"Item excluido com sucesso"}'); 
    });

    $app->run(); // 9 passo colocar na memória, carrega todos os EndPoint para execução
?>