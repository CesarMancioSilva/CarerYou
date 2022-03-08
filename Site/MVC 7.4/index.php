<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="View/assets/css/home.css" />
  <link rel="stylesheet" href="View/assets/css/Nav-scadastro.css" />
  <link rel="stylesheet" href="View/assets/css/footer.css" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
  <title>Carer You</title>
</head>

<body>
  <header>
    <nav class="navbar">
      <input id="hamburger" type="checkbox" style="display: none" />
      <label for="hamburger">
        <div class="hamburger"></div>
      </label>
      <img id="logo-monitor" src="View/assets/img/logo.png" />
      <ul>
        <li href="#"><a href="./View/locais.php">ASILOS/CASAS DE REPOUSO</a></li>
        <li><a href="./View/cuidadores.php">CUIDADORES</a></li>
        <?php
        if (isset($_SESSION['TIPO'])) {
          if ($_SESSION['TIPO'] == "Admin") {
            echo '<li><a href="./View/adm.php">ADM</a></li>';
          }
        }
        ?>
        <li class="nav-menu"><a href="#">SOBRE NÓS</a></li>
        <li class="nav-menu"><a href="#">CONTATE-NOS</a></li>
        <li class="nav-menu"><a href="#">FAQ</a></li>
      </ul>
      <a href="login.php"><img id="icon-entrar" src="View/assets/img/login.png" /></a>
      <?php
      if (isset($_SESSION['ID'])) {
        echo '<a href="./Controller/php/Deslogar.php" class="buttons-lc"><button id="nav-entrar" style="background-color: red;">SAIR</button></a>';
      } else {
        echo '<a class="buttons-lc" href="View/login.php"><button id="nav-entrar">LOGIN</button></a>
              <a class="buttons-lc" href="View/cadastro.php"><button id="nav-cadastro">CADASTRO</button></a>';
      }
      ?>
    </nav>
  </header>
  <div id="back1">
    <div id="txt1">
      <div class="txt" id="a1">
        <img id="background4" src="View/assets/img/background4.png" />
        <h1>
          ENCONTRE O PROFISSIONAL<br />
          IDEAL PARA SUA FAMILIA
        </h1>
        <br />
        <div id="subtitulo1">
          <p>
            Localize cuidadores, casas de repouso e asilos mais perto de você
            e sua familia
          </p>
        </div>
        <br />
        <button>SAIBA MAIS</button>
      </div>
      <div id="a2"></div>
    </div>
  </div>
  <div id="back2">
    <div id="esquerda1">
      <img class="cuidadora2" id="cd2" src="View/assets/img/cuidadora2.png" />
      <img class="cuidadora2" id="cd3" src="View/assets/img/cuidadora3.png" />
      <img class="cuidadora2" id="cd4" src="View/assets/img/cuidadora4.png" />
      <img class="cuidadora2" id="cd5" src="View/assets/img/cuidadora5.png" />
    </div>
    <div class="txt" id="direita1">
      <ul>
        <li>
          <h1>CUIDADORES</h1>
          <br />
        </li>
        <li>
          <div id="subtitulos-back">
            <p>
              Localize cuidadores, casas de repouso e asilos mais perto de
              você e sua familia. Localize cuidadores, casas de repouso e
              asilos mais perto de você e sua familia
            </p>
          </div>
        </li>
        <br />
        <li><button><a href="./View/cuidadores.php" style="color:white;text-decoration:none;">SAIBA MAIS</a></button></li>
      </ul>
    </div>
  </div>
  <div id="back3">
    <div class="txt" id="esquerda2">
      <ul>
        <li>
          <h1>ASILOS E CASAS DE REPOUSO</h1>
          <br />
        </li>
        <li>
          <div id="subtitulos-back">
            <p>
              Localize cuidadores, casas de repouso e asilos mais perto de
              você e sua familia. Localize cuidadores, casas de repouso e
              asilos mais perto de você e sua familia
            </p>
          </div>
        </li>
        <br />
        <li><button>SAIBA MAIS</button></li>
      </ul>
    </div>
    <div class="txt" id="direita2">
      <ul id="local-texto-mobile">
        <li>
          <h1>ASILOS E CASAS DE REPOUSO</h1>
          <br />
        </li>
        <li>
          <div id="subtitulos-back">
            <p>
              Localize cuidadores, casas de repouso e asilos mais perto de
              você e sua familia. Localize cuidadores, casas de repouso e
              asilos mais perto de você e sua familia
            </p>
          </div>
        </li>
        <br />
        <li><button>SAIBA MAIS</button></li>
      </ul>
    </div>
  </div>
  <div id="a">
    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="footer-col">
            <img src="View/assets/img/logo.png" />
          </div>
          <div class="footer-col">
            <h4>Navegação</h4>
            <ul>
              <li><a href="#">Asilos</a></li>
              <li><a href="#">Casas de repouso</a></li>
              <li><a href="#">Cuidadores</a></li>
              <li><a href="#">Doações</a></li>
            </ul>
          </div>
          <div class="footer-col">
            <h4>Desenvolvedores</h4>
            <ul>
              <li><a href="View/sobre1.html">Sobre nós</a></li>
              <li><a href="View/contato.html">Contate-nos</a></li>
              <li><a href="#">Instituição</a></li>
            </ul>
          </div>
          <div class="footer-col">
            <h4>Redes sociais</h4>
            <div class="social-links">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
              <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
  <script src="View/scripts/home.js"></script>
</body>

</html>