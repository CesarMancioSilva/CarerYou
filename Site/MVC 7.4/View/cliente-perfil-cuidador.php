<?php
require_once("../Model/model.php");
$id = (int)$_GET['id'];
$res = $DAO->infoProfissional($id);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carer You</title>
    <link rel="stylesheet" href="assets/css/nav-scadastro.css">
    <link rel="stylesheet" href="assets/css/cliente-perfil-cuidador.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
</head>

<body>
    <header style="background-color: white;">
        <nav class="navbar">
            <input id="hamburger" type="checkbox" style="display: none" />
            <label for="hamburger">
                <div class="hamburger"></div>
            </label>
            <a href="../"><img id="logo-monitor" src="https://cdn.glitch.global/bcdafbd3-05af-45a7-8f68-a12a50835e89/logo.png?v=1645195527997" /></a>
            <ul>
                <li href="#"><a href="./locais.php">ASILOS/CASAS DE REPOUSO</a></li>
                <li><a href="./cuidadores.php">CUIDADORES</a></li>
                <li><a href="../">HOME</a></li>
                <?php
                if (isset($_SESSION['TIPO']) && $_SESSION['TIPO'] == "Admin") {
                    echo '<li><a href="./adm.php">ADM</a></li>';
                }
                ?>
                <li class="nav-menu"><a href="#">SOBRE NÓS</a></li>
                <li class="nav-menu"><a href="#">CONTATE-NOS</a></li>
                <li class="nav-menu"><a href="#">FAQ</a></li>
            </ul>
            <img id="icon-entrar" src="https://cdn.glitch.global/bcdafbd3-05af-45a7-8f68-a12a50835e89/login.png?v=1645195535033" />
            <?php
            if (isset($_SESSION['ID'])) {
                echo '<a href="../Controller/php/Deslogar.php" class="buttons-lc"><button id="nav-entrar" style="background-color: red; color:white; border: none;">SAIR</button></a>';
            } else {
                echo '<a class="buttons-lc" href="./login.php"><button id="nav-entrar">LOGIN</button></a>
              <a class="buttons-lc" href="./cadastro.php"><button id="nav-cadastro" >CADASTRO</button></a>';
            }
            ?>
        </nav>
    </header>
    <div class="espaçamento">.</div>
    <div class="content">
        <div class="header-cuid">
            <div class="left-nav">
                <div class="header-left">
                    <?php
                    echo "<img src='./assets/img/profile pic/" . $res['FOTO'] . "'>"
                    ?>
                    <ul>
                        <li class="Nome-header" style="display: flex;"><?php echo "<b>" . $res['NOME'] . "</b><div id='genero-header'>(" . $res['GENERO'] . ")</div>"; ?></li>
                        <?php
                        echo "<li>" . $res['STATUS'] . "</li>";
                        ?>
                    </ul>
                </div>
                <ul class="button-left">
                    <li><button>Solicitar Serviço</button></li>
                    <li><button>Ver Certificação</button></li>
                </ul>


            </div>
            <div class="right-nav">
                <ul>
                    <?php
                    echo "<li>" . $res['EMAIL'] . "</li>
                          <li>" . $res['CIDADE'] . " - " . $res['ESTADO'] . "</li>"
                    ?>
                </ul>
            </div>
        </div>

        <div class="feedback-div">
            <div class="aval-div">
                <div class="card-aval">
                    <h2>Avaliações</h2>
                    <hr>
                    <div class="star-div">
                        <img src="assets/img/star.png">
                        <div class="media-div">
                            <div class="media">4.2</div>
                            <br>
                            <div class="qnt-media">+99 avaliações</div>
                        </div>
                    </div>

                </div>

            </div>


            <div class="coment-div">
                <h2>Comentarios de clientes</h2>
                <hr>
                </hr>
                <div class="scroll-card-div">

                    <div class="comment-card">
                        <div class="header-comment">
                            <img>
                            <ul>
                                <li><b>Nome de Usuário</b></li>
                                <li style="color:gray;">22 de agosto de 2022</li>
                            </ul>
                            <span>Santos - SP</span>
                        </div>
                        <div class="comment-txt-div">Lorem ipsum maecenas senectus eleifend, viverra inceptos aptent quisque, sed egestas euismod. volutpat convallis morbi taciti eu porttitor porta ac augue etiam leo habitasse semper lorem, sem mollis ante integer pretium proin tellus primis et velit aliquet mi.</div>
                        <hr>
                    </div>
                    <div class="comment-card">
                        <div class="header-comment">
                            <img>
                            <ul>
                                <li><b>Nome de Usuário</b></li>
                                <li style="color:gray;">22 de agosto de 2022</li>
                            </ul>
                            <span>Santos - SP</span>
                        </div>
                        <div class="comment-txt-div">Lorem ipsum maecenas senectus eleifend, viverra inceptos aptent quisque, sed egestas euismod. volutpat convallis morbi taciti eu porttitor porta ac augue etiam leo habitasse semper lorem, sem mollis ante integer pretium proin tellus primis et velit aliquet mi.</div>
                        <hr>
                    </div>




                </div>




            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <img src="assets/img/logo.png" />
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

    <script src="scripts/cliente-perfil-cuidador.js"></script>
    <script src="scripts/icone-modal.js"></script>
</body>

</html>