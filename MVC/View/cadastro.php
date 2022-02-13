<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/cadastro.css">
    <link rel="stylesheet" href="assets/css/Nav-scadastro.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    
    <title>Cadastro</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <input id="hamburger"type="checkbox" style="display:none">
            <label for="hamburger">
                <div class="hamburger"></div>
            </label>
            
            <a href="home.php"><img id="logo-monitor"src="assets/img/logo.png"></a>
            <ul>
                
                <li href="#"><a href="#">ASILOS/CASAS DE REPOUSO</a></li>
                <li><a href="#">CUIDADORES</a></li>
                <li class="nav-menu"><a href="#">SOBRE NÓS</a></li>
                <li class="nav-menu"><a href="#">CONTATE-NOS</a></li>
                <li class="nav-menu"><a href="#">FAQ</a></li>
                
                
                
              
            </ul>
            <a  href="login.html"><img id="icon-entrar"src="assets/img/login.png"></a>
            
            <a class="buttons-lc" href="login.php"><button id="nav-entrar">LOGIN</button></a>
            <a class="buttons-lc" href="cadastro.php"><button id="nav-cadastro">CADASTRO</button></a>
            

        </nav></header>
        <div class="content">
            <div class="pngLeft"><img src="assets/img/cadastro-leftpng.png"></div>
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
                            <div class="subtitulo">Ja possui uma conta? <a href="#">Conecte-se</a></div>
                        </div>
                        <div class="input-div">

                            <div class="column-passos2">
                                    <div class="caixa2" id="caixa1">1</div>
                                    <div class="linha2"></div>
                                    <div class="caixa2" id="caixa2">2</div>
                                    <div class="linha2"></div>
                                    <div class="caixa2" id="caixa3">3</div>
                            </div>

                            <form>
                                <div class="parte1">
                                    <input class="nome"type="text" placeholder="Nome de usuario">
                                    <div class="quebraform">
                                        <div class="quebra-esquerda">
                                            <input type="email" placeholder="Email">
                                            <input type="password" placeholder="Senha">
                                            <input type="password" placeholder="Confirmar senha">
                                        </div>
                                        <div class="quebra-direita">
                                            <input type="text" placeholder="Numero do RG (Registro Geral)">
                                            <div class="quebra-direitapp">
                                                    <select placeholder="Região"class="quebraInput"name="cars" id="cars">
                                                            <option value="volvo">Masculino</option>
                                                            <option value="saab">Feminino</option>
                                                            <option value="saab">Prefiro não informar</option>
                                                            
                                                    </select>
                                                    <select placeholder="Gênero"class="quebraInput"name="cars" id="cars">
                                                            <option value="volvo">São Paulo</option>
                                                            <option value="saab">Santos</option>
                                                    </select>
                                                
                                            </div> 
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="parte2">
                                   2
                                </div>
                                <div class="parte3">
                                   3
                                </div>
    
                                
                                
                            </form>
                        </div>
                       
                    </div>

                    <div class="cadastro-nav">
                        <div class="NextBackdiv">
                            <button class="btnVoltar" onclick="voltar()">VOLTAR</button>
                            <button class="btnContinuar"onclick="proximo()">CONTINUAR</button>
                        </div>
                        <button class="cadastrar">CADASTRAR</button>
                    </div>

                </div>

            </div>
            <div class="pngRight"><img src="assets/img/cadastro-rightpng.png"></div>
        </div>
        <script src="scripts/cadastro.js"></script>
    
</body>
</html>