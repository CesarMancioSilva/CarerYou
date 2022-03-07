<?php
session_start();
if ($_SESSION['TIPO'] != "Admin") {
  header("Location: ../");
}
require_once("../Model/model.php");
$ADM = new AdminDAO();
$res = $ADM->UsuariosAnalise();
//echo var_dump($res);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/menu-adm.css" />
  <link rel="stylesheet" href="assets/css/adm.css" />
  <title>Carer You</title>
</head>

<body>
  <nav class="menu-side">
    <img class="logo" src="assets/img/logobranco.png" />
    <ul class="lateral-navegação">
      <li class="Chat">Chat</li>
      <li class="Cuidadores" style="margin-bottom: 0">Cuidadores</li>
      <li class="sub-menu" onclick="analiseF()" id="analise">Analise</li>
      <li class="sub-menu" onclick="listaF()" id="listaCuid">
        Lista de cuidadores
      </li>

      <li class="Locais">Locais</li>
      <li class="Notificações">Notificações</li>
      <li class="Perfil">Perfil</li>
    </ul>
    <div class="bottom-profile">
      <img alt="" />
      <ul>
        <li>César Mancio Silva</li>
        <li>Administrador Carer You</li>
      </ul>
    </div>
  </nav>
  <div class="Content-analise">
    <div class="analise-content">
      <h2>Lista de cadastros em analise</h2>
      <div class="linha-title"></div>
      <!-- <input placeholder="Pesquise o pedido aqui..." type="search" /> -->
      <?php
      if ($res === []) {
        echo "Nenhum usuario em fase de analise...";
      } else {
      ?>
        <div id="responseArea">
          <?php
          foreach ($res as $value) {
            echo '<div class="card-analise">
            <div class="header-card">
              <div class="imgCard">
                <img src="./assets/img/profile pic/' . $value['FOTO'] . '"/>
                <ul>
                  <li class="nome-cuidador">' . $value['NOME'] . '</li>
                  <li class="região-cuidador">' . $value['CIDADE'] . '</li>
                </ul>
              </div>
            </div>
            <button onclick="viewContent(' . $value['ID_PROFISSIONAL'] . ')">Analisar</button>
          </div>';
          }
          ?>
        </div>
      <?php } ?>
    </div>

    <div class="cuidador-content" style="display: none;">
      <img onclick="closeContent()" class="backArrow" src="assets/img/arrow-back-regular-84.png" />
      <div class="cuidador-header">
        <img id="imgU" />
      </div>
      <div class="info1">
        <div class="esquerda-info">
          <ul class="nome-info">
            <li>Nome de usuário</li>
            <li class="selected-info" id="nomeU"></li>
          </ul>
          <ul class="região-info">
            <li>Região</li>
            <li class="selected-info" id="cidadeU"></li>
          </ul>
        </div>
        <div class="esquerda-info">
          <ul class="email-info">
            <li>Email de cadastro</li>
            <li class="selected-info" id="emailU"></li>
          </ul>
          <ul class="Genero-info">
            <li>Genero</li>
            <li class="selected-info" id="generoU"></li>
          </ul>
        </div>
      </div>
      <hr />
      <div class="info2">
        <ul class="RG-info">
          <li>RG (Registro Geral)</li>
          <li class="selected-info" id="rgU"></li>
        </ul>
        <ul class="PDF-info">
          <li>PDF de Certificação</li>
          <li class="selected-info" id="certificadoU"></li>
        </ul>
      </div>

      <div class="Button-div">
        <button class="Permitir" onclick="PermitirU()">Permitir</button>
        <button class="Recusar">Recusar</button>
      </div>
    </div>
  </div>
  <script src="../Controller/ajax/usuariosAnalise.js"></script>
  <script src="scripts/menu-adm.js"></script>
</body>

</html>