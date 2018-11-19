<?php
  require_once("sessao.php");
  
  $acao = $_GET['acao'];
  $codigo = $_GET['codigo'];
  $acaoenv = $_POST['acaoenv'];
  $titulo = $_POST['titulo'];
  $uf = $_POST['uf'];
  $tabela = 'qs_cidades';
  $urldois = 'index.php?pg=view_cidades';
  $row = Conexao::fetch("SELECT * FROM $tabela WHERE codigo='$codigo'");

  if($acaoenv=='publicar'){
    $insert = Conexao::insert("INSERT INTO $tabela (titulo,uf)VALUES('$titulo','$uf')");
    echo "<div class='alertyes'>Publicação efetuada com sucesso!</div>";
    echo "<script>setTimeout(function() {window.location.href='$urldois';}, 2000);</script>";
  }
  if($acaoenv=='editar'){
    $update = Conexao::update("UPDATE $tabela SET titulo='$titulo', uf='$uf' WHERE codigo='$codigo'");
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
                  <label class="control-label">Cidade</label>
                  <div class="controls">
                    <input id="titulo" type="text" name="titulo" value="<?php echo $row->titulo;?>" />
                  </div>
                </div>
              </div>
              <div id="form-wizard-1" class="step">
                <div class="control-group">
                  <label class="control-label">Estado</label>
                  <div class="controls">
                    <select name="uf">
                      <option value="AC" <?php echo $row->uf=='AC' ? 'selected="selected"' : '';?>>Acre</option>
                      <option value="AL" <?php echo $row->uf=='AL' ? 'selected="selected"' : '';?>>Alagoas</option>
                      <option value="AP" <?php echo $row->uf=='AP' ? 'selected="selected"' : '';?>>Amapá</option>
                      <option value="AM" <?php echo $row->uf=='AM' ? 'selected="selected"' : '';?>>Amazonas</option>
                      <option value="BA" <?php echo $row->uf=='BA' ? 'selected="selected"' : '';?>>Bahia</option>
                      <option value="CE" <?php echo $row->uf=='CE' ? 'selected="selected"' : '';?>>Ceará</option>
                      <option value="DF" <?php echo $row->uf=='DF' ? 'selected="selected"' : '';?>>Distrito Federal</option>
                      <option value="ES" <?php echo $row->uf=='ES' ? 'selected="selected"' : '';?>>Espírito Santo</option>
                      <option value="GO" <?php echo $row->uf=='GO' ? 'selected="selected"' : '';?>>Goiás</option>
                      <option value="MA" <?php echo $row->uf=='MA' ? 'selected="selected"' : '';?>>Maranhão</option>
                      <option value="MT" <?php echo $row->uf=='MT' ? 'selected="selected"' : '';?>>Mato Grosso</option>
                      <option value="MS" <?php echo $row->uf=='MS' ? 'selected="selected"' : '';?>>Mato Grosso do Sul</option>
                      <option value="MG" <?php echo $row->uf=='MG' ? 'selected="selected"' : '';?>>Minas Gerais</option>
                      <option value="PA" <?php echo $row->uf=='PA' ? 'selected="selected"' : '';?>>Pará</option>
                      <option value="PB" <?php echo $row->uf=='PB' ? 'selected="selected"' : '';?>>Paraíba</option>
                      <option value="PR" <?php echo $row->uf=='PR' ? 'selected="selected"' : '';?>>Paraná</option>
                      <option value="PE" <?php echo $row->uf=='PE' ? 'selected="selected"' : '';?>>Pernambuco</option>
                      <option value="PI" <?php echo $row->uf=='PI' ? 'selected="selected"' : '';?>>Piauí</option>
                      <option value="RJ" <?php echo $row->uf=='RJ' ? 'selected="selected"' : '';?>>Rio de Janeiro</option>
                      <option value="RN" <?php echo $row->uf=='RN' ? 'selected="selected"' : '';?>>Rio Grande do Norte</option>
                      <option value="RS" <?php echo $row->uf=='RS' ? 'selected="selected"' : '';?>>Rio Grande do Sul</option>
                      <option value="RO" <?php echo $row->uf=='RO' ? 'selected="selected"' : '';?>>Rondônia</option>
                      <option value="RR" <?php echo $row->uf=='RR' ? 'selected="selected"' : '';?>>Roraima</option>
                      <option value="SC" <?php echo $row->uf=='SC' ? 'selected="selected"' : '';?>>Santa Catarina</option>
                      <option value="SP" <?php echo $row->uf=='SP' ? 'selected="selected"' : '';?>>São Paulo</option>
                      <option value="SE" <?php echo $row->uf=='SE' ? 'selected="selected"' : '';?>>Sergipe</option>
                      <option value="TO" <?php echo $row->uf=='TO' ? 'selected="selected"' : '';?>>Tocantins</option>
                    </select>
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
