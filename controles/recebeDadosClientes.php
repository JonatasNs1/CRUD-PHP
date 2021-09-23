<?php



//require_once("../bd/inserirDadosClientes.php");
    /*****************************************************************************
        Objetivo: arquivo responsavel por receber os dados,tratar os dados e validar os dados de cliente
        Data: 15/09/2021
        Autor: Jonatas Santos
    
    ******************************************************************************/
//import do arquivo configuração de variaveis e constantes
require_once('../functions/config.php');
//import do arquivo para inserir no banco de dados
require_once(SRC .'bd/inserirCliente.php');

    //Declaração de variaveis
    $nome = (string) null;
    $rg = (string) null;
    $cpf = (string) null;
    $telefone = (string) null;
    $celular = (string) null;
    $email = (string) null;
    $obs = (string) null;

    

    //$_SERVER['REQUEST_METHOD'] - Verifica qual tipo de requisição que foi encaminhada pelo forn(GET/POST)
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        //Recebe os dados encaminhados pelo formulario, através do metodo POST
        $nome = $_POST['txtNome'];
        $rg = $_POST['txtRg'];
        $cpf = $_POST['txtCpf'];
        $telefone = $_POST['txtTelefone'];
        $celular = $_POST['txtCelular'];
        $email = $_POST['txtEmail'];
        $obs = $_POST['txtObs'];
        
        //Validação de campos obrigatórios
    if($nome == null || $rg == null || $cpf == null)
    {
        echo ("<script> 
            alert('".ERRO_CAIXA_VAZIA."');
            window.history.back();
        </script>");  
    }
        //validacao de quantidade de caracteres
        //strlen($nome)>100 - Retorna a quantidade de caracteres de uma variavel
    elseif(strlen($nome)>100 || strlen($rg) >15 || strlen($cpf) > 20)
        {
              echo ("<script> 
            alert('".ERRO_MAXLENGHT."');
            window.history.back(); 
        </script>"); 
        }
        else{
            //local para enviar os dados para o Banco de dados
            //criacao de um array para encaminhar a função de inserir
            $cliente = array(
                  "nome" => $nome,
                "rg" => $rg,
                "cpf" => $cpf,
                "telefone" =>$telefone,
                "celular" =>$celular,
                "email" =>$email,
                "obs" =>$obs,
                
            );
            //chama a função inserir do arquivo inserirCliente.php, e encaminha o array com os dados do cliente.
           if (inserir($cliente)) //tratamento para ver se os dados chegaram no banco
                echo ("
                    <script>
                        alert('". BD_MSG_INSERIR ."');
                        window.location.href = '../index.php';
                    </script>
                    " );
            else
                echo ("
                    <script>
                        alert('". BD_MSG_ERRO ."');
                         window.history.back();
                    </script>
                ");
        }
    
        
    }


?>