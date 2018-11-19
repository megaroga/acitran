<?php
  require_once("sessao.php");
  
  $acao = $_GET['acao'];
  $codigo = $_GET['codigo'];
  $acaoenv = $_POST['acaoenv'];
  
  $titulo = $_POST['titulo'];
  $cod_cidade = $_POST['cod_cidade'];
  $cod_bairro = $_POST['cod_bairro'];
  $coord = $_POST['coord'];
  $endereco = $_POST['endereco'];
  $veiculo = $_POST['veiculo'];
  $qtd_envolvidos = $_POST['qtd_envolvidos'];
  $qtd_mortes = $_POST['qtd_mortes'];
  $tp_socorro = $_POST['tp_socorro'];

  $tabela = 'qs_ocorrencias';
  $urldois = 'index.php?pg=view_ocorrencias';
  $row = Conexao::fetch("SELECT * FROM $tabela WHERE codigo='$codigo'");
  $houratual = date("Y-m-d H:i:s");

  if($acaoenv=='publicar'){
    $data_ocorrencia = $Funcoes::DataHoraAmerican($_POST['data_ocorrencia']);
    $insert = Conexao::insert("INSERT INTO $tabela (titulo,cod_cidade,cod_bairro,coord,endereco,veiculo, qtd_envolvidos,qtd_mortes,tp_socorro,data_ocorrencia,data_cadastro)VALUES('$titulo','cod_cidade','$cod_bairro','$coord','$endereco','$veiculo','$qtd_envolvidos','$qtd_mortes','$tp_socorro','$data_ocorrencia',NOW())");
    echo "<div class='alertyes'>Publicação efetuada com sucesso!</div>";
    echo "<script>setTimeout(function() {window.location.href='$urldois';}, 2000);</script>";
  }
  if($acaoenv=='editar'){
    $data_ocorrencia = $Funcoes::DataHoraAmerican($_POST['data_ocorrencia']);
    $update = Conexao::update("UPDATE $tabela SET titulo='$titulo', cod_cidade='$cod_cidade', cod_bairro='$cod_bairro', coord='$coord', endereco='$endereco', veiculo='$veiculo', qtd_envolvidos='$qtd_envolvidos', qtd_mortes='$qtd_mortes', tp_socorro='$tp_socorro', data_ocorrencia='$data_ocorrencia' WHERE codigo='$codigo'");
    echo "<div class='alertyes'>Edição efetuada com sucesso!</div>";
    echo "<script>setTimeout(function() {window.location.href='$urldois';}, 2000);</script>";
  }
?>

<script type="text/javascript">
function cidadesAjax(veja_cat) { //alert(cod_categoria); return false;
    $.ajax({
    url: 'cidades.php?acao=vejacidad',
    type: 'POST',
    data: 'veja_cat='+veja_cat,
    dataType  : 'html',
        success : function(txt){
                $('#AjaxCidad').html(txt);
            }
  })
}  
</script>

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
                  <label class="control-label">Titulo</label>
                  <div class="controls">
                    <input id="titulo" type="text" name="titulo" value="<?php echo $row->titulo;?>" />
                  </div>
                </div>
              </div>

              <div id="form-wizard-1" class="step">
                <div class="control-group">
                  <label class="control-label">Cidades</label>
                  <div class="controls">
                    <select id="cod_cidade" class="form-control" name="cod_cidade" onChange="cidadesAjax(this.options[this.selectedIndex].value)">
                      <option value="">Selecione...</option>
                      <?php 
                        $cocatVeja = Conexao::fetchAll("SELECT codigo,titulo FROM qs_cidades");
                        foreach ($cocatVeja as $key => $vejaCattd) {?>
                        <option value="<?php echo $vejaCattd->codigo;?>" <?php echo ($row->cod_cidade==$vejaCattd->codigo ? "selected" : ""); ?>><?php echo $vejaCattd->titulo;?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>

              <div id="form-wizard-1" class="step">
                <div class="control-group">
                  <label class="control-label">Bairros</label>
                  <div class="controls">
                      <div id="AjaxCidad">
                        <?php if($acao=='publicar'){?>
                        <select id="cod_bairro" class="form-control" name="cod_bairro">
                          <option value="">Selecione a cidade</option>
                        </select>
                        <?php }else {?>
                          <select id="cod_bairro" class="form-control" name="cod_bairro">
                            <?php 
                              $VejaSubcat = Conexao::fetchAll("SELECT codigo,titulo FROM qs_bairros");
                              foreach ($VejaSubcat as $key => $vejaCattd) {?>
                              <option value="<?php echo $vejaCattd->codigo;?>" <?php echo ($row->cod_bairro==$vejaCattd->codigo ? "selected" : ""); ?>><?php echo $vejaCattd->titulo;?></option>
                            <?php } ?>
                          </select>
                        <?php } ?>
                      </div>
                  </div>
                </div>
              </div>

              <div id="form-wizard-1" class="step">
                <div class="control-group">
                  <label class="control-label">Coordenada</label>
                  <div class="controls">
                    <input id="coord" type="text" name="coord" value="<?php echo $row->coord;?>" />
                  </div>
                </div>
              </div>
              <div id="form-wizard-1" class="step">
                <div class="control-group">
                  <label class="control-label">Endereço</label>
                  <div class="controls">
                    <input id="endereco" type="text" name="endereco" value="<?php echo $row->endereco;?>" style="min-width: 600px;"/>
                  </div>
                </div>
              </div>
              <div id="form-wizard-1" class="step">
                <div class="control-group">
                  <label class="control-label">Veiculos envolvidos</label>
                  <div class="controls">
                    <input id="veiculo" type="text" name="veiculo" value="<?php echo $row->veiculo;?>" />
                  </div>
                </div>
              </div>

              <div id="form-wizard-1" class="step">
                <div class="control-group">
                  <label class="control-label">Nº Envolvidos</label>
                  <div class="controls">
                    <input id="qtd_envolvidos" type="number" name="qtd_envolvidos" value="<?php echo $row->qtd_envolvidos;?>" />
                  </div>
                </div>
              </div>

              <div id="form-wizard-1" class="step">
                <div class="control-group">
                  <label class="control-label">Mortes</label>
                  <div class="controls">
                    <input id="qtd_mortes" type="number" name="qtd_mortes" value="<?php echo $row->qtd_mortes;?>" />
                  </div>
                </div>
              </div>

              <div id="form-wizard-1" class="step">
                <div class="control-group">
                  <label class="control-label">Tempo de socorro(minutos)</label>
                  <div class="controls">
                    <input id="tp_socorro" type="number" name="tp_socorro" value="<?php echo $row->tp_socorro;?>" />
                  </div>
                </div>
              </div>

              <div id="form-wizard-1" class="step">
                <div class="control-group">
                  <label class="control-label">Data da ocorrência</label>
                  <div class="controls">
                    <input id="data_ocorrencia" type="text" name="data_ocorrencia" value="<?php echo ($row->data_ocorrencia=="" ? date("d/m/Y H:i:s") : $Funcoes::daxCont($row->data_ocorrencia)); ?>" />
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
