<?php
    //ativa a utilização de variaveis de sessão
      session_start();

//declaração de variavel para o formulario/ edidar daados
    $nome =(string) null;
    $telefone =(string) null;
    $cpf =(string) null;
    $rg =(string) null;
    $celular = (string) null;
    $email = (string) null;
    $obs = (string) null;
    $id = (int) 0;

    // import do arquivo de configuração de variaveis e constantes
    require_once('functions/config.php');

    require_once(SRC . 'bd/conexaoMysql.php');
    conexaoMysql();

    require_once(SRC. 'controles/exibirDadosClientes.php');

  if(isset($_SESSION['cliente'])) //edidar daados
  {
         $id = $_SESSION['cliente']['idcliente'];
      $nome = $_SESSION['cliente']['nome'];
       $telefone = $_SESSION['cliente']['telefone'];
        $cpf = $_SESSION['cliente']['cpf'];
      $rg = $_SESSION['cliente']['rg'];
      $celular =$_SESSION['cliente']['celular'];
      $email = $_SESSION['cliente']['email'];
      $obs = $_SESSION['cliente']['obs'];
      
      //elimina um objeto, variavel da memoria edidar daados
      unset($_SESSION['cliente']);
  }
    //var_dump($_SESSION['cliente']);


?>
<!DOCTYPE>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title> Cadastro </title>
        <link rel="stylesheet" type="text/css" href="style/style.css">

    </head>
    <body>
        <div id="cadastro"> 
            <div id="cadastroTitulo"> 
                <h1> Cadastro de Contatos </h1>
            </div>
            
            <!-- 
                Principais elementos de formularios para HTML5

                <input type="tel"> - indica que a caixa recebe um telefone

                <input type ="email"> - indica que a caixa recebe um email com o minimo necessario para ser um email (@)

                <input type = "url"> - indica que a caixa recebe uma URL valida (http://)

                <input type ="number"> - indica que a caixa recebe apenas numeros inteiros
                
                <input type ="range"> - cria um elemento tipo barra de rolagem horizontal

                <input type="color"> - cria uma paleta de cor para escolha do usuário
                
                <input type="date"> - cria um calendário para escolha da data
                
                <input type = "month"> - cria um calendario para escolha somente do mes e do ano
                
                <input type = "week"> - cria um calendario que retorna o numero da semana do ano
 

            -->
            <div id="cadastroInformacoes">
        
                <form action="controles/recebeDadosClientes.php" name="frmCadastro" method="post" >
                   
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Nome: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtNome" value="<?=$nome?>" placeholder="Digite seu Nome" maxlength="100">
                        </div>
                    </div>
                    
                     <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> RG: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtRg" value="<?=$rg?>" maxlength="20">
                        </div>
                    </div>
                    
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> CPF: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtCpf" value="<?=$cpf?>" maxlength="20">
                        </div>
                    </div>
                    
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Telefone: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="tel" name="txtTelefone" value="<?=$telefone?>" maxlength="16">
                        </div>
                    </div>
                    
                    
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Celular: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="tel" name="txtCelular" value="<?=$celular?>" maxlength="17">
                        </div>
                    </div>
                    
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Email: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="email" name="txtEmail" value="<?=$email?>" maxlength="60">
                        </div>
                    </div>
                    
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Observações: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <textarea name="txtObs" cols="50" rows="7"><?=$obs?></textarea>
                        </div>
                    </div>
                    
                    <div class="enviar">
                        <div class="enviar">
                            <input type="submit" name="btnEnviar" value="Salvar">
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
        <div id="consultaDeDados">
            <table id="tblConsulta" >
                <tr>
                    <td id="tblTitulo" colspan="5">
                        <h1> Consulta de Dados.</h1>
                    </td>
                </tr>
                <tr id="tblLinhas">
                    <td class="tblColunas destaque"> Nome </td>
                    <td class="tblColunas destaque"> Celular </td>
                    <td class="tblColunas destaque"> Email </td>
                    <td class="tblColunas destaque"> Opções </td>
                </tr>
                <?php
                $dadosClientes = exibirClientes();
                
                while ($rsClientes = mysqli_fetch_assoc($dadosClientes))
                {
                ?>
                <tr id="tblLinhas">
                    <td class="tblColunas registros"><?=$rsClientes['nome']?></td>
                    <td class="tblColunas registros"><?=$rsClientes['celular']?></td>
                    <td class="tblColunas registros"><?=$rsClientes['email']?></td>
                    <td class="tblColunas registros">
                        <a href="controles/editaDadosClientes.php?id=<?=$rsClientes['idcliente']?>">
                          <img src="img/edit.png" alt="Editar" title="Editar" class="editar"> 
                        </a>
                      
                        
                       <a onclick="return confirm('Tem certeza que deseja excluir?');" href="controles/excluiDadosClientes.php?id=<?=$rsClientes['idcliente']?>"> 
                            <img src="img/trash.png" alt="Excluir" title="Excluir" class="excluir">
                        </a>   
                        
                        <img src="img/search.png" alt="Visualizar" title="Visualizar" class="pesquisar">
                    </td>
                </tr>
                <?php  
                    }
                ?>
                
            </table>
        </div>
    </body>
</html>