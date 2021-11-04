<?php 
/*********************************************************%
    Objetivo: Arquivos de configuração de variaveis e constantes que serão utilizados no sistema
    Data: 15/09/2021
    Autor: Jonatas Santos


*************************************/

//constante para indicar a raiz do servidor mais a estrutura de diretórios até o meu projeto
define ('SRC', $_SERVER['DOCUMENT_ROOT'].'/ds2t20212/jonatas/crud/'); 

//Variaveis e constantes para conexão com o banco de dados Mysql
const BD_SERVER = 'localhost';   
const BD_USER= 'root';
const BD_PASSWORD= 'bcd127';
const BD_DATABASE = 'dbcontatos20212t';  

//mensagens de erro do sistema
const ERRO_CONEXAO_BD= "Não foi possivel realizar a conexão com o Banco de Dados, entre em contado com o Administrador do sistema";
const ERRO_CAIXA_VAZIA= "Não foi possivel realizar a operação, pois existem campos obrigatórios a serem preenchidos";
const ERRO_MAXLENGHT= "Não foi possivel realizar a operação, pois a quantidade de caracteres ultrapassa o permitido no Banco de dados";

// Mensagens de aceitação e validação de dados no BD
const BD_MSG_INSERIR = "Registro salvo com sucesso do banco de dados!";
const BD_MSG_EXCLUIR = "
                    <script> 
                        alert('Registro excluido com sucesso do Banco de Dados'); 
                        window.location.href='../index.php';
                    </script>";
const BD_MSG_ERRO = "ERRO: Não foi possivel manipular os dados no Banco de dados!!!";  

//Constantes para Upload de arquivos
define( 'NOME_DIRETORIO_FILE', 'arquivos/');
$extensoesPermitidasFile = array ("image/png", "image/jpg"," image/jpeg");
define('EXTENSOES_PERMITIDAS', $extensoesPermitidasFile);
const TAMANHO_FILE = "5120"; //5 mg = 5120




?>