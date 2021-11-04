<?php

      /*****************************************************************************
        Objetivo: Arquivo para fazer upload de Imagens
        Data: 03/11/2021
        Autor: Jonatas Santos
    
    ******************************************************************************/

    // require_once('../functions/config.php');
    //Função para fazer upload de arquivos
    function uploadFile($arrayFile)
    {
        $fotoFile = $arrayFile; // 4 passo

        $tamanhoOriginal = (int) 0; //5 passo
        $tamanhoKB = (int) 0; //6 passo
        $extensao = (string) null; // 9 passo
        $tipoArquivo = (string) null; // 11 passo
        $nomeArquivo = (string) null; //16 passo
        $nomeArquivoCript =(string) null; //19 passo
        $foto = (string) null; //20 passo
        $arquivoTemp=(string) null; //22 passo
        // var_dump($arrayFile); //1 passo
        // die; //2 passo

        // 5 passo valida se o arquivo existe no array, fazendo a conversao
        if ( $fotoFile['size'] > 0 && $fotoFile['type'] != "" )
        {
            //7 passo recebe o tamanho original do arquivo em byte
            $tamanhoOriginal = $fotoFile['size'];

            // 8 passo converte o tamanho original em KBytes
            $tamanhoKB = $tamanhoOriginal/1024;

            //10 passo recebe o tipo original do arquivo, ou seja, (jpg,png) etc...
           $tipoArquivo =  $fotoFile['type'];     

            // 12 passo - valida se o tamanho do arquivo é menor do que o permitido(do que o configurado)
           if($tamanhoKB <= TAMANHO_FILE )
           {
                if( in_array($tipoArquivo, EXTENSOES_PERMITIDAS )) //  14 passo- Validação para percorrer o array de extensoes permitidas buscando a extensao do arquivo atual, se encontrar retorna true 
                {
                    $nomeArquivo = pathinfo($fotoFile['name'], PATHINFO_FILENAME);//17 passo, Permite extrair apenas o nome de um arquivo sem a extensão
                    $extensao = pathinfo($fotoFile['name'], PATHINFO_EXTENSION); //18 passo, Permite extrair apenas a extensao de um arquivo sem o nome
                
                    // echo( $extensao );
                    // die;


                    /*
                    Algoritmos de criptografia no PHP
                    hash('sha256', 'variavel')
                    sha1('variavel'
                    md5('variavel')) 
                    */
                    // uniqid ()- gera uma sequencia numérica com base nas configurações de hardware da maquina
                    //time() - pega a hora, minuto e segundo atual, nunca vão se repetir
                    $nomeArquivoCript = md5( $nomeArquivo.uniqid(time()));
                    // echo($nomeArquivoCript);
                    // die;
                    $foto = $nomeArquivoCript.".".$extensao; //21 passo- monta o novo nome do arquivo + a extenxão
                    
                    //22 passo - Recebe o nome do arquivo temporario que foi gerado quando o apache recebeu o arquivo do forme
                    $arquivoTemp = $fotoFile['tmp_name'];
                    // echo( SRC.NOME_DIRETORIO_FILE.$foto); // teste
                    // die;


                    // 23 passo - pega um arquivo de um lugar e move para outro lugar, 
                    //arquivo fisicamente do apache e movendo para aquela pasta arquivo e movendo vai colocar o nome e a extenxao, tirando do arquivo temporario para mandar pro servidor
                    // se ele consegui mover, ele retorna true, sempre true, se não retornar é porque deu errado
                    //move_uploaded_file - move o arquivo da pasta temporaria do arquivo para a pasta do servidor que foi criada
                   if(move_uploaded_file($arquivoTemp, SRC.NOME_DIRETORIO_FILE.$foto)){
                        return $foto;
                   } else{
                       echo('Erro no upload do arquivo');
                   }
                }else{
                    echo('Erro de tipo de arquivo'); //15 passo
                }
           }else{
               echo('Erro tamanho do arquivo'); //13 passo
           }
        }

    }



?>