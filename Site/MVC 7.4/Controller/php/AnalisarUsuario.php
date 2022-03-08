<?php
require_once("../../Model/model.php");
if (isset($_POST['id'])) {
    $id = (int)addslashes($_POST['id']);
    if (!empty($id)) {
        $ADM = new AdminDAO();
        $res = $ADM->getDetalhesProfissional($id);
        echo json_encode($res);
    }
} else if (isset($_POST['idPermicao'])) {
    $idPermicao = (int)addslashes($_POST['idPermicao']);
    if (!empty($idPermicao)) {
        $ADM = new AdminDAO();
        $res = $ADM->permitirProfissional($idPermicao);
    }
}
