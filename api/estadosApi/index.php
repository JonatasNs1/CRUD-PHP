<?php
    require_once("vendor/autoload.php");
    $app = new \Slim\App();

    $app->get('/estados', function($request, $response, $args){ 
     
        return $response  -> withStatus(200)
                            ->withHeader('Content-Type', 'application/json')
                            ->write('{"message":"Listar Estados"}');

    });

    $app->run();

    

    //instalar o composer.setup na maquina
    //cria uma pasta
    //abre a pasta e pega a url dela
    //abre o cmd e da um cd com a url para entrar na pasta
    //e dps dar o comando composer require slim/slim "^3.0"
    //só isso

?>