<?php
require_once("../../Model/model.php");
if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = (string)addslashes($_POST['email']);
    $senha = (string)addslashes($_POST['senha']);
    if (!empty($email) && !empty($senha)) {
        $res = $DAO->loginUsuario($email, $senha);
        if ($res !== false) {
            echo "Sucesso";
        } else {
            echo "Login Invalido";
        }
    } else {
        echo "Preencha todos os campos";
    }
}
