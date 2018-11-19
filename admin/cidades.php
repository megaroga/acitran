<?php
include("../conexao/connection.php");
date_default_timezone_set('America/Cuiaba');
 switch ($_GET['acao']) {
    case 'vejacidad':

        $vejares = Conexao::fetchAll("SELECT codigo,titulo FROM qs_bairros WHERE cod_cidade='$_POST[veja_cat]' ORDER BY titulo ASC");

        echo "<select id='cod_bairro' class='form-control' name='cod_bairro'>";
        echo "<option value='' selected>Selecione...</option>";
          foreach ($vejares as $key => $vejaCattd) {
            echo "<option value='$vejaCattd->codigo'>$vejaCattd->titulo</option>";
          }
        echo "</select>";

    break;
 }
?>
