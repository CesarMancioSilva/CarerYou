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
    if (!empty($nome) && !empty($email) && !empty($senha) && !empty($confirmaSenha) && !empty($rg)  && !empty($genero) && !empty($regiao) && !empty($tipoUsuario) && !empty($image) && !empty($certificado)) {
        echo "Tudo aqui<br>";
        if ($tipoUsuario === "Profissional" && $certificado['name'] === "") {
            echo "Insira o arquivo de certificação profissional";
        } else {
            echo "Usuario ok<br>";
            if ($senha === $confirmaSenha) {
                echo "Senhas iguais<br>";
                if (strlen($senha) >= 8) {
                    echo "Senha válida";
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
