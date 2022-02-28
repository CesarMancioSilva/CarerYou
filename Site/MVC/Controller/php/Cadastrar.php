<?php
require_once("../../Model/model.php");
if (isset($_POST['nome'])) {
    $nome = (string)addslashes($_POST['nome']);
    $email = (string)addslashes($_POST['email']);
    $senha = (string)addslashes($_POST['senha']);
    $confirmaSenha = (string)addslashes($_POST['confirmSenha']);
    $rg = (string)addslashes($_POST['rg']);
    $genero = (string)addslashes($_POST['genero']);
    $regiao = (string)addslashes($_POST['regiao']);
    $tipoUsuario = (string)addslashes($_POST['tipoUsuario']);
    $image = $_FILES['image'];
    $certificado = $_FILES['certificado'];
    //echo var_dump($certificado);
    //echo "<br>" . var_dump($image);
    if (!empty($nome) && !empty($email) && !empty($senha) && !empty($confirmaSenha) && !empty($rg)  && !empty($genero) && !empty($regiao) && !empty($tipoUsuario) && !empty($image['name']) && !empty($certificado)) {
        if ($tipoUsuario === "Profissional" && $certificado['name'] === "") {
            echo "Insira o arquivo de certificação profissional";
        } else {
            if ($senha === $confirmaSenha) {
                if (strlen($senha) >= 8) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        if (strlen($rg) === 12) {
                            if ($tipoUsuario === "Cliente") {
                                $arquivoFoto = new Imagem("foto", $image);
                                $usuario = new Usuario($nome, $email, $senha, $rg, $genero, $regiao, $tipoUsuario, $arquivoFoto);
                                $DAO->cadastrarUsuario($usuario);
                            } else if ($tipoUsuario === "Profissional") {
                                //Fazer forma de cadastro de usuario
                            }
                        } else {
                            echo "Digite todos os numeros do seu RG";
                        }
                    } else {
                        echo "E-mail inválido";
                    }
                } else {
                    echo "A senha precisa conter oito caracteres";
                }
            } else {
                echo "As senhas precisam ser iguais";
            }
        }
    } else {
        echo "Preencha todos os campos";
    }
}
