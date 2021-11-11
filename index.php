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
    //variaveis para trazer os valores do Estado para a edição
    $idEstado = (int) null; //10 passo do tblEstado
    $sigla = (string) "Selecione um Item"; //11 passo do tblEstado
    $foto = (string) "semFoto.png";//2 passo para exibir a foto na hora do editar

    // essa variavel $modo(modo salvar, modo atualizar) sera utilizada para definir o modo de manipulação com o banco de dados
    //(se ela for salvar= sera feito o insert
    //se ela for atualizar = sera feito o update) cria na hora que for fazer a atualizar
    $modo = (string) "Salvar"; 

    // import do arquivo de configuração de variaveis e constantes
    require_once('functions/config.php');

    require_once(SRC . 'bd/conexaoMysql.php');
    conexaoMysql();

    require_once(SRC. 'controles/exibirDadosClientes.php');


    // 3 arquivo para ser criado, para o tblestados, import do arquivo que lista todos os estados do bd
    require_once(SRC. 'controles/listarDadosEstados.php');

    // esse if verifica a existencia da variavel sessão que usamos para trazer os dados para o editar
  if(isset($_SESSION['cliente'])) //edidar daados, tirando da session e colocando em variaveis locais
  {
      $id = $_SESSION['cliente']['idcliente'];
      $nome = $_SESSION['cliente']['nome'];
      $telefone = $_SESSION['cliente']['telefone'];
      $cpf = $_SESSION['cliente']['cpf'];
      $rg = $_SESSION['cliente']['rg'];
      $celular =$_SESSION['cliente']['celular'];
      $email = $_SESSION['cliente']['email'];
      $obs = $_SESSION['cliente']['obs'];
      $idEstado = $_SESSION['cliente']['idEstado'];//11 passo do tblEstado
      $sigla = $_SESSION['cliente'] ['sigla'];//12 passo do tblEstado
      $foto = $_SESSION['cliente'] ['foto']; //1 passo para exibir a foto na hora do editar
      $modo = "Atualizar"; 
      
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
        <script src="js/jquery.js" ></script>
        
            <!-- Teste, ready/ evento, elemento que vc quer(document) a (.ready, ler o navegador)ação(ready) e dps a função

                1- passo para criar o modal
-->
        <script>
            $(document).ready(function(){
                //Alterando uma propriedade de css ao carregar da pagina
                $('#containerModal').css('display','none');
//                alert('teste');
                //Abre a modal
               $('.pesquisar').click(function(){
//                    alert('teste');
                   $('#containerModal').slideToggle(1000); // abrir o elemento
                   
                   
                   let idCliente = $(this).data('id');
//                   alert(idCliente);
                   //resgatando o id, this(aquele elemento que eu cliquei) chamando a variavel data atributo
                   //ajax- realiza uma requisiçaõ para consumir dados de uma outra pagina
                   $.ajax({
                        type: "GET", // tipo de requisiçaõ (get, post, put, etc)
                       url:  "visualizarDados.php", //url da página que será consumida
                      data: {id:idCliente}, // criando uma variavel chamando id, que ira levar o idCliente que nós resgatamos, recebe o id do cliente que foi adicionado pelo dara atributo html
                       success: function(dados) { //se a requisição der certo, iremos receber o conteudo na variavel dados
                       
                           $('#modal').html(dados); //Exibe dentro da div Modal
                       }
                      
                  }); // ajax - permite manipular arquivos externos, precisa passar a requisiçaõ para ele, get ou post, success como se fosse um if, argumento (dados) pode ser qualquer nome
                   //get - pegar alguma coisa, consultar algo no banco de dados e trazendo para ca (buscar e trazer)
                   // Post -  se preciso pegar algo da minha pagina para enviar para alguma coisa(bd) (pegar dados do seu arquivo e mandar para outro lugar)
               });
                
                //Fecha o modal
                $('#fecharModal').click(function(){
                   $('#containerModal').fadeOut(); 
                });
            });
            
        
        </script>
    </head>
    <body>
        
        <div id="containerModal">
            <span id="fecharModal"> Fechar</span>
            <div id="modal">
                
            </div>
        
        </div>
        
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
        
                <!-- 
                    Adicionando o $modo e o id no action & - concatena para criar mais um elemento no html

                    As variaveis modo e id, foram utilizadas no action do form, são responsaveis por encaminhar para a pagina recebeDadosClientes.php duas informações:
                    modo - que é responsavel por definir se é para inserir ou atualizar 
                    id - que é responsavel por identificar o registro a ser utilizado no BD

                -->

                <!-- 2 passo enctype="multipart/form-data" - é obrigatório ser utilizado quando for trabalhar com imagens
                        obs: (Para trabalhar com a input type="file") é obrigatório utilizar o metodo POST
                      foto-  essa variavel foto começa como nulo e começa ter alguma coisa quando passa pelo editar
                        
                -->
                <form enctype="multipart/form-data" action="controles/recebeDadosClientes.php?modo=<?=$modo?>&id=<?=$id?>&nomeFoto=<?=$foto?>" name="frmCadastro" method="post" >
                   
                   
                    
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Nome: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtNome" value="<?=$nome?>" placeholder="Digite seu Nome" maxlength="100">
                        </div>
                    </div>
                    
                    <!-- Primeiro passo -->
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Foto: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="file" name="fleFoto" accept="image/jpeg, image/jpg, image/png">
                        </div>
                        <div id="visualizarFoto">  <!--3 passo para exibir a foto na hora do editar, esse (nome ) é o caminho -->
                            <img src="<?= NOME_DIRETORIO_FILE.$foto?>"> 

                        </div>
                    </div>
                    
                     <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Estados: </label>
                        </div>
                          <div class="cadastroEntradaDeDados">
                        <select name="sltEstado">
                                    <!--13 passo no tblEstado-->
                                <option selected value="<?=$idEstado?>"> <?=$sigla?>  </option> 
                            <?php 
                                // 4 passo- para fazer o tblEstados
                                    //chama a função que vai buscar todos os estados no banco
                                   $listEstados= exibirEstados();
                                    
                                    //repetição para exibir os dados do BD
                                    while($rsEstados = mysqli_fetch_assoc($listEstados))
                                    {
                                        ?>
                                            <option value="<?=$rsEstados['idEstado']?>"> <?=$rsEstados['sigla']?></option>
                                        <?php
                                    }
                                    
                            ?>
                            </select>
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
                            <input type="submit" name="btnEnviar" value="<?=$modo?>">
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
        <div id="consultaDeDados">
            <table id="tblConsulta" >
                <tr>
                    <td id="tblTitulo" colspan="6">
                        <h1> Consulta de Dados.</h1>
                    </td>
                </tr>
                <tr id="tblLinhas">
                    <td class="tblColunas destaque"> Nome </td>
                    <td class="tblColunas destaque"> Celular </td>
                    <td class="tblColunas destaque"> Email </td>
                    <td class="tblColunas destaque"> Foto </td>
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
                    <td class="tblColunas registros"><img class= "foto"src="<?= NOME_DIRETORIO_FILE.$rsClientes['foto']?>"></td>
                    <td class="tblColunas registros">
                        <a href="controles/editaDadosClientes.php?id=<?=$rsClientes['idcliente']?>">
                          <img src="img/edit.png" alt="Editar" title="Editar" class="editar"> 
                        </a>
                      
                        
                       <a onclick="return confirm('Tem certeza que deseja excluir?');" href="controles/excluiDadosClientes.php?id=<?=$rsClientes['idcliente']?> &foto=<?=$rsClientes['foto']?>"> 
                            <img src="img/trash.png" alt="Excluir" title="Excluir" class="excluir">
                        </a>   
                        
                        <img src="img/search.png" alt="Visualizar" title="Visualizar" class="pesquisar" data-id="<?=$rsClientes['idcliente']?>">
                    </td>
                </tr>
                <?php  
                    }
                ?>
                
            </table>
        </div>
    </body>
</html>