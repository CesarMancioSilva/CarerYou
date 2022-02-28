<?php
require_once("../Model/model.php");
$generos = $DAO->verGeneros();
$cidades = $DAO->verCidades();
$tiposUsuario = $DAO->verTiposUsuario();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="assets/css/cadastro.css" />
  <link rel="stylesheet" href="assets/css/Nav-scadastro.css" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
  <title>Cadastro</title>
</head>

<body>
  <header>
    <nav class="navbar">
      <input id="hamburger" type="checkbox" style="display: none" />
      <label for="hamburger">
        <div class="hamburger"></div>
      </label>
      <a href="home.php"><img id="logo-monitor" src="https://cdn.glitch.global/bcdafbd3-05af-45a7-8f68-a12a50835e89/logo.png?v=1645195527997" /></a>
      <ul>
        <li href="#"><a href="#">ASILOS/CASAS DE REPOUSO</a></li>
        <li><a href="#">CUIDADORES</a></li>
        <li class="nav-menu"><a href="#">SOBRE NÓS</a></li>
        <li class="nav-menu"><a href="#">CONTATE-NOS</a></li>
        <li class="nav-menu"><a href="#">FAQ</a></li>
      </ul>
      <a href="login.html"><img id="icon-entrar" src="https://cdn.glitch.global/bcdafbd3-05af-45a7-8f68-a12a50835e89/login.png?v=1645195535033" /></a>
      <a class="buttons-lc" href="login.php"><button id="nav-entrar">LOGIN</button></a>
      <a class="buttons-lc" href="cadastro.php"><button id="nav-cadastro">CADASTRO</button></a>
    </nav>
  </header>
  <div class="content">
    <div class="pngLeft"><img src="assets/img/cadastro-leftpng.png" /></div>
    <div class="cadastro">
      <div class="column-passos">
        <div class="caixa" id="caixa1">1</div>
        <div class="linha"></div>
        <div class="caixa" id="caixa2">2</div>
        <div class="linha"></div>
        <div class="caixa" id="caixa3">3</div>
      </div>
      <div class="cadastro-form-div">
        <div class="input-side">
          <div class="titulo">
            <h1>CRIE SUA CONTA !</h1>
            <div class="subtitulo">
              Ja possui uma conta? <a href="#">Conecte-se</a>
            </div>
          </div>
          <div class="input-div">
            <div class="column-passos2">
              <div class="caixa2" id="caixa1mb">1</div>
              <div class="linha2"></div>
              <div class="caixa2" id="caixa2mb">2</div>
              <div class="linha2"></div>
              <div class="caixa2" id="caixa3mb">3</div>
            </div>
            <form method="POST" action="../Controller/php/Cadastrar.php" enctype="multipart/form-data">
              <div class=" parte1">
                <input class="nome" type="text" placeholder="Nome de usuario" id="nomeUsuario" name="nome" />
                <div class="quebraform">
                  <div class="quebra-esquerda">
                    <input type="email" placeholder="Email" id="emailUsuario" name="email" />
                    <input type="password" placeholder="Senha" id="senhaUsuario" name="senha" />
                    <input type="password" placeholder="Confirmar senha" id="senhaConfirmUsuario" name="confirmSenha" />
                  </div>
                  <div class="quebra-direita">
                    <input type="text" placeholder="Numero do RG (Registro Geral)" id="rgUsuario" maxlength="12" name="rg" />
                    <div class="quebra-direitapp">
                      <select placeholder="Gênero" class="quebraInput" name="genero" id="generoUsuario">
                        <?php
                        foreach ($generos as $values) {
                          echo "<option value='" . $values['DS_GENERO_USUARIO'] . "'>" . $values['DS_GENERO_USUARIO'] . "</option>";
                        }
                        ?>
                      </select>
                      <select placeholder="Região" class="quebraInput" name="regiao" id="regiãoUsuario">
                        <?php
                        foreach ($cidades as $values) {
                          echo "<option value='" . $values['NM_CIDADE'] . "'>" . $values['NM_CIDADE'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="parte2">
                <div class="OPradio">
                  <?php
                  echo '<input onclick="OPcl()" type="radio"id="OPcliente" name="tipoUsuario" value="' . $tiposUsuario[0]['DS_TIPO_USUARIO'] . '"/>
                  <label for="OPcliente">' . $tiposUsuario[0]['DS_TIPO_USUARIO'] . '</label>
                  <input onclick="OPcu()" type="radio" id="OPcuidador" name="tipoUsuario" value="' . $tiposUsuario[1]['DS_TIPO_USUARIO'] . '" />
                  <label for="OPcuidador">' . $tiposUsuario[1]['DS_TIPO_USUARIO'] . '</label><br />';
                  ?>
                </div>
                <div class="clienteDiv">
                  <div class="main-cliente">
                    <img class="preview" />
                    <div class="txtDiv">
                      <div class="mm">
                        <h3>Adicione uma foto de perfil</h3>
                        <p>
                          Escola uma foto sua ou de seu familiar para
                          idntificação na plataforma.
                        </p>
                        <div class="confirmação-cliente-div">
                          <label class="cuid-button" for="fotoArquivo">Selecionar arquivo</label>
                          <p id="confirmação">Nenhum arquivo selecionado</p>
                        </div>
                        <input type="file" name="image" class="custom-file-input" id="fotoArquivo" style="display: none" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="cuidadorDiv">
                  <div class="cuidador-foto-div">
                    <img class="preview2" />
                    <ul>
                      <li>
                        <h3>Adicione uma foto de perfil</h3>
                      </li>
                      <li>
                        <label class="cuid-button" for="fotoArquivo">
                          Escolher arquivo
                        </label>
                      </li>
                      <li id="confirmação2">Nenhum arquivo selecionado</li>
                    </ul>
                  </div>
                  <label for="certif-Input">
                    <div class="areaArquivo">
                      <div id="file-upload-filename">
                        Clique para adicionar um arquivo pdf certificando a
                        atuação na area
                      </div>
                    </div>
                  </label>
                  <input type="file" id="certif-Input" name="certificado" onchange="verificaExtensao(this)" style="display: none" />
                </div>
              </div>
              <div class="parte3">
                <h2>Privacidade e Termos</h2>
                <div class="caixatxt">
                  <h3><b>SUBTITULO</b></h3>
                  <p>
                    Lorem ipsum quam est nisl id tempus id habitasse, primis
                    phasellus massa egestas non conubia. aliquam vitae in sed
                    dapibus aliquet luctus nam tempus, ornare sapien sit
                    commodo per in ullamcorper ornare eros, purus inceptos
                    egestas turpis duis nam pretium. mauris enim porttitor
                    lorem pulvinar ad erat urna velit tempus orci, urna ad
                    aenean pulvinar elit a donec nunc. auctor himenaeos mi
                    venenatis vestibulum consequat praesent curabitur eget,
                    integer massa himenaeos risus mi purus et libero litora,
                    erat vel vehicula nisl aptent class suspendisse. non
                    inceptos euismod aenean erat in pulvinar malesuada, turpis
                    torquent quis nec metus congue gravida nam, nullam nunc
                    maecenas porta elit tempus. non inceptos euismod aenean
                    erat in pulvinar malesuada, turpis torquent quis nec metus
                    congue gravida nam, nullam nunc maecenas porta elit
                    tempus.
                  </p>
                  <br />
                  <h3><b>SUBTITULO</b></h3>
                  <p>
                    Varius cubilia eros tellus adipiscing nunc aliquet leo
                    sapien gravida, hendrerit metus ac quis tempus vivamus
                    dictumst cras magna, dapibus aenean nulla ac neque rhoncus
                    maecenas fames. adipiscing potenti bibendum nullam
                    bibendum nunc lacinia dapibus ultrices fringilla mauris,
                    sagittis sapien ullamcorper malesuada laoreet aenean
                    ornare ut dapibus vehicula, diam ipsum condimentum erat
                    nisl fringilla velit ultrices amet. nam et morbi tincidunt
                    neque odio sapien fusce magna nisl gravida, posuere nec
                    senectus aenean hendrerit libero curae lacus. non mattis
                    tempus cubilia sagittis neque inceptos etiam, ultrices a
                    felis mi bibendum tortor enim fames, tellus tincidunt
                    semper ornare cursus maecenas.
                  </p>
                  <br />
                  <h3><b>SUBTITULO</b></h3>
                  <p>
                    Varius cubilia eros tellus adipiscing nunc aliquet leo
                    sapien gravida, hendrerit metus ac quis tempus vivamus
                    dictumst cras magna, dapibus aenean nulla ac neque rhoncus
                    maecenas fames. adipiscing potenti bibendum nullam
                    bibendum nunc lacinia dapibus ultrices fringilla mauris,
                    sagittis sapien ullamcorper malesuada laoreet aenean
                    ornare ut dapibus vehicula, diam ipsum condimentum erat
                    nisl fringilla velit ultrices amet. nam et morbi tincidunt
                    neque odio sapien fusce magna nisl gravida, posuere nec
                    senectus aenean hendrerit libero curae lacus. non mattis
                    tempus cubilia sagittis neque inceptos etiam, ultrices a
                    felis mi bibendum tortor enim fames, tellus tincidunt
                    semper ornare cursus maecenas.
                  </p>
                  <br />
                  <h3><b>SUBTITULO</b></h3>
                  <p>
                    Varius cubilia eros tellus adipiscing nunc aliquet leo
                    sapien gravida, hendrerit metus ac quis tempus vivamus
                    dictumst cras magna, dapibus aenean nulla ac neque rhoncus
                    maecenas fames. adipiscing potenti bibendum nullam
                    bibendum nunc lacinia dapibus ultrices fringilla mauris,
                    sagittis sapien ullamcorper malesuada laoreet aenean
                    ornare ut dapibus vehicula, diam ipsum condimentum erat
                    nisl fringilla velit ultrices amet. nam et morbi tincidunt
                    neque odio sapien fusce magna nisl gravida, posuere nec
                    senectus aenean hendrerit libero curae lacus. non mattis
                    tempus cubilia sagittis neque inceptos etiam, ultrices a
                    felis mi bibendum tortor enim fames, tellus tincidunt
                    semper ornare cursus maecenas.
                  </p>
                </div>
                <div class="checkTermo-Div">
                  <input type="checkbox" id="checkTermo" />
                  <label for="checkTermo">Li e aceito os Termos de uso do CarerYou</label>
                </div>
                <h3 id="parte1-Span">
                  Preencha todos os campos para passar para próxima etapa
                </h3>
              </div>

              <input type="submit" id="submit" style="display: none" />
            </form>
          </div>
        </div>
        <div class="cadastro-nav">
          <div class="NextBackdiv">
            <button class="btnVoltar" onclick="voltar()">VOLTAR</button>
            <button class="btnContinuar" onclick="proximo()">
              CONTINUAR
            </button>
          </div>
          <label for="submit" class="cadastrar">CADASTRAR</label>
        </div>
      </div>
    </div>
    <div class="pngRight"><img src="assets/img/cadastro-rightpng.png" /></div>
  </div>
  <script src="scripts/cadastro.js"></script>
  <script src="../Controller/ajax/cadastrarUsuario.js"></script>
</body>

</html>