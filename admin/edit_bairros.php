<?php
  require_once("sessao.php");
  
  $acao = $_GET['acao'];
  $codigo = $_GET['codigo'];
  $codcid = $_GET['codcid'];
  $acaoenv = $_POST['acaoenv'];
  $titulo = $_POST['titulo'];
  $coord = $_POST['coord'];
  $tabela = 'qs_bairros';
  $urldois = 'index.php?pg=view_bairros&codcid='.$codcid;
  $row = Conexao::fetch("SELECT * FROM $tabela WHERE codigo='$codigo'");

  if($acaoenv=='publicar'){
    $insert = Conexao::insert("INSERT INTO $tabela (titulo,coord,cod_cidade)VALUES('$titulo','$coord','$codcid')");
    echo "<div class='alertyes'>Publicação efetuada com sucesso!</div>";
    echo "<script>setTimeout(function() {window.location.href='$urldois';}, 2000);</script>";
  }
  if($acaoenv=='editar'){
    $update = Conexao::update("UPDATE $tabela SET titulo='$titulo', coord='$coord',codcid='$codcid' WHERE codigo='$codigo'");
    echo "<div class='alertyes'>Edição efetuada com sucesso!</div>";
    echo "<script>setTimeout(function() {window.location.href='$urldois';}, 2000);</script>";
  }
?>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-pencil"></i> </span>
            <h5>Publicar/Editar</h5>
          </div>
          <div class="widget-content nopadding">
            <form id="form-wizard" class="form-horizontal" method="post">
              <input id="acaoenv" name="acaoenv" type="hidden" value="<?php echo $acao;?>" />
              <div id="form-wizard-1" class="step">
                <div class="control-group">
                  <label class="control-label">Bairro</label>
                  <div class="controls">
                    <input id="titulo" type="text" name="titulo" value="<?php echo $row->titulo;?>" />
                  </div>
                </div>
              </div>

              <div id="form-wizard-1" class="step">
                <div class="control-group">
                  <label class="control-label">Coordenadas</label>
                  <div class="controls">
                    <input id="coord" type="text" name="coord" value="<?php echo $row->coord;?>" />
                  </div>
                </div>
              </div>
              
              <div class="form-actions">
                <input id="next" class="btn btn-primary" type="submit" value="Salvar" />
                <div id="status"></div>
              </div>
              <div id="submitted"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
