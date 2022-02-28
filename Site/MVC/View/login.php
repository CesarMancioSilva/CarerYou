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
            <a href="home.php"><img id="logo-monitor" src="assets/img/logo.png"></a>
            <ul>
                <li href="#"><a href="#">ASILOS/CASAS DE REPOUSO</a></li>
                <li><a href="#">CUIDADORES</a></li>
                <li><a href="home.html">HOME</a></li>
                <li class="nav-menu"><a href="#">SOBRE NÓS</a></li>
                <li class="nav-menu"><a href="#">CONTATE-NOS</a></li>
                <li class="nav-menu"><a href="#">FAQ</a></li>
            </ul>
            <a href="login.php"><img id="icon-entrar" src="assets/img/login.png"></a>
            <a class="buttons-lc" href="login.php"><button id="nav-entrar">LOGIN</button></a>
            <a class="buttons-lc" href="cadastro.php"><button id="nav-cadastro">CADASTRO</button></a>
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