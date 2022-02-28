<?php
require_once("../../Model/model.php");
if (isset($_POST['tipoUsuario'])) {
    $nome = (string)addslashes($_POST['nome']);
    $email = (string)addslashes($_POST['email']);
    $senha = (string)addslashes($_POST['senha']);
    $confirmacaoSenha = (string)addslashes($_POST['confirmSenha']);
    $rg = (string)addslashes($_POST['rg']);
    $genero = (string)addslashes($_POST['genero']);
    $cidade = (string)addslashes($_POST['regiao']);
    $tipoUsuario = (string)addslashes($_POST['tipoUsuario']);
    $fotoPerfil = $_FILES['image'];
    $certificado = $_FILES['certificado'];
    if (!empty($nome) && !empty($email) && !empty($senha) && !empty($confirmacaoSenha) && !empty($rg) && !empty($genero) && !empty($cidade) && !empty($tipoUsuario) && !empty($fotoPerfil['name'])) {
        if (strlen($rg) === 12) {
            if ($senha === $confirmacaoSenha) {
                if (strlen($senha) > 7) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        if (preg_match("/^[a-zA-Z-' ]*$/", $nome)) {
                            $foto = new Imagem($fotoPerfil);
                            if ($tipoUsuario === "Cliente") {
                                $u = new Usuario($nome, $email, $senha, $rg, $genero, $cidade, $tipoUsuario, $foto);
                                $response = $DAO->cadastrarUsuario($u);
                            } else if ($tipoUsuario === "Profissional") {
                                //Fazer cadastro do tipo cuidador
                                $pdf = new PDF($certificado);
                                $u = new Profissional($nome, $email, $senha, $rg, $genero, $cidade, $tipoUsuario, $foto);
                                $u->setCertificado($pdf);
                                $response = $DAO->cadastrarUsuario($u);
                                if ($response === true) {
                                    echo "Usuario cadastrado com sucesso";
                                } else {
                                    echo $response;
                                }
                            }
                        } else {
                            echo "Nome inválido";
                        }
                    } else {
                        echo "E-mail inválido";
                    }
                } else {
                    echo "A senha deve conter 8 caracteres";
                }
            } else {
                echo "As senhas precisam ser iguais";
            }
        } else {
            echo "Insira seu RG completo";
        }
    } else {
        echo "Preencha todos os campos";
    }
} else {
    echo "Preencha todos os campos";
}
