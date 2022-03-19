<?php
session_start();
require_once("../Model/model.php");
$res = $DAO->ListaLocais();
//echo var_dump($res);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carer You</title>
    <link rel="stylesheet" href="assets/css/Nav-scadastro.css">
    <link rel="stylesheet" href="assets/css/cuidadores.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <input id="hamburger" type="checkbox" style="display: none" />
            <label for="hamburger">
                <div class="hamburger"></div>
            </label>
            <a href="../"><img id="logo-monitor" src="https://cdn.glitch.global/bcdafbd3-05af-45a7-8f68-a12a50835e89/logo.png?v=1645195527997" /></a>
            <ul>
                <li href="#"><a href="#">ASILOS/CASAS DE REPOUSO</a></li>
                <li><a href="./cuidadores.php">CUIDADORES</a></li>
                <li><a href="../">HOME</a></li>
                <?php
                if (isset($_SESSION['TIPO'])) {
                    if ($_SESSION['TIPO'] == "Admin") {
                        echo '<li><a href="./adm.php">ADM</a></li>';
                    }
                }
                ?>
                <li class="nav-menu"><a href="#">SOBRE NÓS</a></li>
                <li class="nav-menu"><a href="#">CONTATE-NOS</a></li>
                <li class="nav-menu"><a href="#">FAQ</a></li>
            </ul>
            <a href="login.html"><img id="icon-entrar" src="https://cdn.glitch.global/bcdafbd3-05af-45a7-8f68-a12a50835e89/login.png?v=1645195535033" /></a>
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
    <!-- <div class="title-main">
        <div class="left"></div>
        <div class="title">
            <h3> BUSQUE CUIDADORES COM FACILIDADE</h3>
        </div>
        <div class="right"></div>
    </div> -->

    <div class="all-content">
        <div class="filtro-div">
            <input placeholder="Pesquise por nomes..." type="search">

            <div class="filtro-card">

                <div class="filtro-categoria">
                    <h3>Cidade</h3>
                    <div class="conjunto-input">
                        <div class="input-div">
                            <input name="Cidade" id="Santos" type="radio"><label for="Santos">Santos</label>
                        </div>
                        <div class="input-div">
                            <input name="Cidade" id="SãoVicente" type="radio"><label for="SãoVicente">São Vicente</label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="filtro-categoria">
                    <h3>Tipo de local</h3>
                    <div class="conjunto-input">
                        <div class="input-div">
                            <input name="Gênero" id="Feminino" type="radio"><label for="Feminino">Asilo</label>
                        </div>
                        <div class="input-div">
                            <input name="Gênero" id="Masculino" type="radio"><label for="Masculino">Casa de repouso</label>
                        </div>
                    </div>
                </div>

            </div>

            <div class="paginação-div">
                <img src="assets/img/chevron-left-regular-24.png">
                <ul>
                    <li><a href="">1</a></li>
                    <li><a href="">2</a></li>
                    <li><a href="">3</a></li>
                    <li><a href="">...</a></li>
                    <li><a href="">10</a></li>
                </ul>
                <img src="assets/img/chevron-right-regular-24.png">
            </div>

        </div>

        <div class="cards-div">
            <?php
            //$res = false;
            if ($res === []) {
                echo "Não existem locais dentro do sistema...";
            } else {
                foreach ($res as $value) {
                    echo '<div class="card-profissional">
                        <img src="./assets/img/local-pic/' . $value['FOTO'] . '">
                        <div class="info-profissional">
                            <div class="background-card"></div>
                             ' . $value['FOTO'] . '
                            <h3>' . $value['NOME'] . '</h3>
                            <div class="status-div">
                                <span class="status" style="color:#00B2FF;">' . $value['TIPO_LOCAL'] . '</span>
                            </div>
                            <span style="display: block;">' . $value['CIDADE'] . '</span>
                        </div>

                        <button>Ver mais</button>
                    </div>';
                }
            }
            ?>
        </div>

    </div>

</body>

</html>