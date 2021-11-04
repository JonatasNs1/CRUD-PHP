<?php
    // buscar um dado no banco
    // 2 passo para criar um modal

        // import do arquivo visualizarDadosClientes.php

    require_once('controles/visualizarDadosClientes.php');


    //Recebe o id enviado pelo ajax na pagina da index
    $id =$_GET['id'];
//    echo($id);


    //  chama a funcao para buscar no banco de dados
    $dadosCliente = visualizarCliente($id);

//    var_dump($dadosCliente); // conferindo se o array chegou
    
?>

<html>
    <!--Primeiro passo-->
    <head>
        <title> Visualizar</title>
    
    </head>

    <body>
        <table>
            <tr>
                <td> Nome: </td>
                <td><?=$dadosCliente['nome'] ?></td>
            </tr>
            
             <tr>
                <td> RG:</td>
                <td><?=$dadosCliente['rg']?></td>
            </tr>
            
             <tr>
                <td> CPF:</td>
                <td><?=$dadosCliente['cpf']?></td>
            </tr>
            
             <tr>
                <td>
                    Telefone:
                </td>
                <td><?=$dadosCliente['telefone']?></td>
            
            </tr>
            
             <tr>
                <td> Celular: </td>
                <td><?=$dadosCliente['celular'] ?></td>
            </tr>
            
             <tr>
                <td> Email: </td>
                <td><?=$dadosCliente['email'] ?></td>
            </tr>
            
           
            <tr>
                <td> OBS:</td>
                <td><?=$dadosCliente['obs']?></td>
            </tr>
            
            
            
        
        
        </table>
    </body>


</html>