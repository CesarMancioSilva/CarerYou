<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carer You</title>
    <link rel="stylesheet" href="assets/css/Nav-scadastro.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <input id="hamburger" type="checkbox" style="display:none">
            <label for="hamburger">
                <div onclick="formf()" class="hamburger"></div>
            </label>
            <a href="../"><img id="logo-monitor" src="assets/img/logo.png"></a>
            <ul>
                <li href="#"><a href="./locais.php">ASILOS/CASAS DE REPOUSO</a></li>
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
            <a href="login.php"><img id="icon-entrar" src="assets/img/login.png"></a>
            <?php
            if (isset($_SESSION['ID'])) {
                echo '<a href="../Controller/php/Deslogar.php" class="buttons-lc"><button id="nav-entrar" style="background-color: red; color:white; border: none;">SAIR</button></a>';
            } else {
                echo '<a class="buttons-lc" href="./login.php"><button id="nav-entrar">LOGIN</button></a>
              <a class="buttons-lc" href="./cadastro.php"><button id="nav-cadastro">CADASTRO</button></a>';
            }
            ?>
        </nav>
    </header>
    <div id="main">
        <h1>FAÇA SEU LOGIN !</h1>
        <form action="" method="POST" autocomplete="on">
            <input class="input-style" type="text" placeholder="Nome de usuário" name="email">
            <input class="input-style" type="password" placeholder="Senha" name="senha">
            <input id="submit" class="input-style" type="submit" value="LOGIN">
        </form>
        <h2>Ainda não possui cadastro? <a href="cadastro.php">Cadastre-se</a></h2>
        <div id="linha"></div>
        <p id="responseArea"></p>
    </div>
    <script src="scripts/login.js"></script>
    <script src="../Controller/ajax/loginUsuario.js"></script>
</body>

</html>