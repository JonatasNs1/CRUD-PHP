<?php

// echo("testando a API"); primeiro passo, para testar
// die;
//import para start do slim php, 2 passo
    require_once("vendor/autoload.php");

    //import do arquivo de configuração do sistema, 3 passo
   // require_once("../functions/config.php");


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

        return $response   ->withStatus(200) // qual é o status que eu vou devolver desse EndPoint, response é como se fosse o echo() //6 passo
                           ->withHeader('Content-Type', 'application/json') //como minha api vai responder quando alguem solicitar //7 passo
                           ->write('{"message":"Resquisição com sucesso"}'); //8 passo
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