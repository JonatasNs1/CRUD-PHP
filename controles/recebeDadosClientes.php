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

require_once(SRC .'bd/atualizarCliente.php');

//import do arquivo que faz o upload de imagens para o servidor
require_once(SRC.'functions/upload.php');

    //Declaração de variaveis
    $nome = (string) null;
    $rg = (string) null;
    $cpf = (string) null;
    $telefone = (string) null;
    $celular = (string) null;
    $email = (string) null;
    $obs = (string) null;
    $idEstado = (int) null; // 5 passo, para o tbl estado

    $foto = (string) null; // variavel criada guardar o nome da foto

    if(isset($_GET['id'])){ // validacao para saber se o id do registro ta chegando pela URL(modo para atualizar o registro)
         $id = (int) $_GET['id'];
    }
   else{
       $id = (int) 0; // esse id será utilizado somente para o editar
   } 

    

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
        $idEstado = $_POST['sltEstado']; //6 passo para o tbl estado
        // var_dump($_FILES['fleFoto']); //teste

        $foto = uploadFile($_FILES['fleFoto']); // chamando a função que faz o upload de um arquivo
        // echo($foto);
        // die;
       
        // die;  // die - serve para parar a execução do código do apache

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
                "id" =>$id,
                "idEstado" => $idEstado, // 7 passo para o tbl estado
                "foto" => $foto
                
            );
            
            // fazer o if na hora que for fazer o atualizar
            //validacao para saber se é para inserir um novo registro ou se é para atualizar um registro existente no bd
            if(strtoupper($_GET['modo']) == 'SALVAR'){
                
           
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
            }elseif(strtoupper($_GET['modo']) == 'ATUALIZAR')//logica para o atualizar
            { 
                //  editar($cliente);
                
                if(editar($cliente))
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
    
        
    }


?>