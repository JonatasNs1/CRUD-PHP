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
    $app = new \Slim\App(); // 4 passo, instalando o slim
    // resposta de sucesso, 200 até 299
    //EndPoint - é um ponto de parada da API, ou seja serão as formas de requisição que a API irá responder, todos tem que dar um retorno
    // -> para acessar metodos da classe
    // significa que alguem está solicitando dados de clientes
    // request - será usado para pegar algo que vai ser enviado para pegar API(recebe), parametros da api
    // response - será utilizado para quando a API irá devolver algo, seja uma mensagem, status, body, header, etc (devolve)
    // args - será os argumentos que podem ser encaminhados para a API, parametros são variaveis que são criadas na api
    $app->get('/clientes', function($request, $response, $args){ // 5 passo, Endpoint: GET, retorna todos dados de clientes
        
       
        // 10 passo, chama a função(Na pasta controles) que vai requisitar os dados no Banco de Dados, uma que vai gerar o array e outra que vai gerar um json
        if($listDados = exibirClientes()){
            //var_dump($listDados); teste para ver se foi 
            //die;
                if( $listDadosArray = criarArray($listDados)){  // criar um array para os dados que estão chegando
                         $listDadosJSON = criarJSON($listDadosArray);
                }
        } 
       
        //Validação para tratar o banco de dados sem conteúdo, (vazio), para testar se ta funcionando é só ir la no crud e excluir, ele tem que aparecer no postaman que ta vazio, e mensagem
        if( $listDadosArray){ //if para ver se tem dados no banco
            return $response   ->withStatus(200) // qual é o status que eu vou devolver desse EndPoint, response é como se fosse o echo() //6 passo
                               ->withHeader('Content-Type', 'application/json') //como minha api vai responder quando alguem solicitar, especificar qual é o tipo de cabeçalho que vai ser mandado para o body //7 passo
                               ->write($listDadosJSON); //Menssagem na tela 8 passo

        }else{
                         return $response   ->withStatus(204); // qual é o status que eu vou devolver desse EndPoint, response é como se fosse o echo() //6 passo
                                            // ->withHeader('Content-Type', 'application/json') //como minha api vai responder quando alguem solicitar, especificar quqal é o tipo de cabeçalho que vai ser mandado para o body //7 passo
                                            // ->write('{"messagem":"Não há dados para essa requisição"}'); //Menssagem na tela, falando o motivo do erro, (que não retornou nd) 8 passo
        }
     

    });

    $app->get('/clientes/{id}', function($request, $response, $args){ // 5 passo, Endpoint: GET, retorna um cliente pelo id, o que vier após a segunda /, ficara armazenada na variavel id
        // sempre que passar algo para url, vai chegar como args exemplo(/clientes/id), args vai trazer o argumento, ele faz uma associação da palavra que vc coloca dentro das {}, nome, id
        
        $id = $args['id']; // recebe o id que será encaminhado na URL, pesquisa pelo id
        // echo($id); // primeiro teste para saber se ta chegando o id (http://localhost/ds2t20212/jonatas/crud/api/clientes/10), se oid que ta sendo passado pela url, ta chegando no endpoint
        // die;

        // 10 passo, chama a função(Na pasta controles) que vai requisitar os dados no Banco de Dados, uma que vai gerar o array e outra que vai gerar um json
        if($listDados = buscarClientes($id)){ // buscar pelo id
            //var_dump($listDados); teste para ver se foi 
            //die;
                if( $listDadosArray = criarArray($listDados)){  // criar um array para os dados que estão chegando
                         $listDadosJSON = criarJSON($listDadosArray);
                }
        } 
       
        //Validação para tratar o banco de dados sem conteúdo, (vazio), para testar se ta funcionando é só ir la no crud e excluir, ele tem que aparecer no postaman que ta vazio, e mensagem
        if( $listDadosArray){ //if para ver se tem dados no banco
            return $response   ->withStatus(200) // qual é o status que eu vou devolver desse EndPoint, response é como se fosse o echo() //6 passo
                               ->withHeader('Content-Type', 'application/json') //como minha api vai responder quando alguem solicitar, especificar qual é o tipo de cabeçalho que vai ser mandado para o body //7 passo
                               ->write($listDadosJSON); //Menssagem na tela 8 passo

        }else{
                         return $response   ->withStatus(204); // qual é o status que eu vou devolver desse EndPoint, response é como se fosse o echo() //6 passo
                                            // ->withHeader('Content-Type', 'application/json') //como minha api vai responder quando alguem solicitar, especificar quqal é o tipo de cabeçalho que vai ser mandado para o body //7 passo
                                            // ->write('{"messagem":"Não há dados para essa requisição"}'); //Menssagem na tela, falando o motivo do erro, (que não retornou nd) 8 passo
        }
     

    });


    $app->post('/clientes', function($request, $response, $args){ //Endpoint: POST, envia um novo cliente para o BD, na api vai ser mandado um json(), ir no postaman, copiar o json() e mudar para post e ir no body-> raw e jogar o json() la

        require_once('../controles/recebeDadosClientesAPI.php'); // 6 passo, import do arquivo que vai encaminhar os dados para o banco de dados
        //1 passo, receber o json()
        $contentType = $request-> getHeaderLine('Content-Type'); // recebe o content type do header, para verificar se o padrao do body será json();
        // echo($contentType); // 2 passo teste
        // die;

        //3 passo, valida se o tipo de dados é JSON()
        if($contentType == 'application/json'){

            // 4 passo recebe o conteudo enviado no body da mensagem
            $dadosBodyJSON = $request-> getParsedBody(); //método que vai trazer o body

            //valida se o corpo do body está vazio
            if( $dadosBodyJSON == "" || $dadosBodyJSON == null) //5 passo
            {
                return $response    ->withStatus(406)
                                    ->withHeader('Content-Type', 'application/json')
                                     ->write('{"message":"Conteudo enviado pelo body não contem dados validos"}');
            }else
            {
                // var_dump($dadosBodyJSON);
                // die;
              

                //inserirClienteAPI($dadosBodyJSON) chamando a função
                //envia os dados para o BD e valida se foi inserido com sucesso
                if(inserirClienteAPI($dadosBodyJSON)){ //7 passo
                    return $response    ->withStatus(201)
                                        ->withHeader('Content-Type', 'application/json')
                                        ->write('{"message":"Item criado com sucesso"}');
                }else{
                    return $response    ->withStatus(400)
                                        ->withHeader('Content-Type', 'application/json')
                                        ->write('{"message":"Não foi possível salvar os dados, por favor conferir o body da mensagem"}');
                }
              
            }

        
        }else
        {
            return $response    ->withStatus(406)
                                ->withHeader('Content-Type', 'application/json')
                                ->write('{"message":"Formato de dados do header incompatível com o padrão json"}');
        }
      
    });


    $app->put('/clientes/{id}', function($request, $response, $args){ //Endpoint: PUT, atualiza um cliente no BD, tem dois caminhos encaminhar o put normal recebendo o id por argumento 
                                                                //ou onde a pessoa encaminhar vai mandar por dentro do json ou pelo id

          $contentType = $request-> getHeaderLine('Content-Type'); // recebe o content type do header, para verificar se o padrao do body será json();
        // echo($contentType); // 2 passo teste
        // die;

        //3 passo, valida se o tipo de dados é JSON()
        if($contentType == 'application/json'){ // se o content type é json

            // 4 passo recebe o conteudo enviado no body da mensagem
            $dadosBodyJSON = $request-> getParsedBody(); //método que vai trazer o body

            
            
            //valida se o corpo do body está vazio
            if( $dadosBodyJSON == "" || $dadosBodyJSON == null || !isset($args['id']) || !is_numeric($args['id']) ) //5 passo
            {
                return $response    ->withStatus(406)
                                    ->withHeader('Content-Type', 'application/json')
                                     ->write('{"message":"Conteudo enviado pelo body não contem dados validos"}');
            }else
            {
                // var_dump($dadosBodyJSON);
                // die;
                $id = $args['id']; // recebe o id que será enviado pela URL

                require_once('../controles/recebeDadosClientesAPI.php'); // 6 passo, import do arquivo que vai encaminhar os dados para o banco de dados
                //inserirClienteAPI($dadosBodyJSON) chamando a função
                //envia os dados para o BD e valida se foi inserido com sucesso
                if(atualizarClienteAPI($dadosBodyJSON,$id)){ //7 passo
                    return $response    ->withStatus(200)
                                        ->withHeader('Content-Type', 'application/json')
                                        ->write('{"message":"Item atualizado com sucesso"}');
                }else{
                    return $response    ->withStatus(400)
                                        ->withHeader('Content-Type', 'application/json')
                                        ->write('{"message":"Não foi possível salvar os dados, por favor conferir o body da mensagem"}');
                }
              
            }

        
        }else
        {
            return $response    ->withStatus(406)
                                ->withHeader('Content-Type', 'application/json')
                                ->write('{"message":"Formato de dados do header incompatível com o padrão json"}');
        }
      
    });
    

    $app->delete('/clientes/{id}', function($request, $response, $args){ //Endpoint:DELETE, exclui um cliente no BD
       
            
            if(!isset($args['id']) || !is_numeric($args['id']) ) //5 passo
            {
                return $response    ->withStatus(406)
                                    ->withHeader('Content-Type', 'application/json')
                                     ->write('{"message":"Não foi encaminhado um ID do registro."}');
            }else
            {
                $id = $args['id']; // recebe o id enviado pela URL
                //import do arquivo de exclusão

                require_once('../controles/excluirDadosClientesAPI.php');
              // 6 passo, import do arquivo que vai encaminhar os dados para o banco de dados
                //inserirClienteAPI($dadosBodyJSON) chamando a função
                //envia os dados para o BD e valida se foi inserido com sucesso
                if(excluirClienteAPI($id)){ //7 passo
                    return $response    ->withStatus(200)
                                        ->withHeader('Content-Type', 'application/json')
                                        ->write('{"message":"Item excluido com sucesso"}');
                }else{
                    return $response    ->withStatus(400)
                                        ->withHeader('Content-Type', 'application/json')
                                        ->write('{"message":"Não foi possível excluir os dados"}');
                }
              
            }

      
      
    });

    $app->run(); // 9 passo colocar na memória, carrega todos os EndPoint para execução
?>