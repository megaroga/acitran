<?php
  require_once("sessao.php");

  $acao = $_GET['acao'];
  $p = $_REQUEST['p'];
  $busca = $_REQUEST['busca'];
  $codcid = $_REQUEST['codcid'];
  $selecionadosAcao = $_REQUEST['selecionadosAcao'];
  $urlReturn = 'view_bairros';
  $urldois = 'index.php?pg=view_bairros&codcid='.$codcid;
  $tabela = 'qs_bairros';

  $out=1;
  $max = ($nRegistros=='' ? 18 : $nRegistros);
  $p = $p + 0;
  $in = $p * $max;
  $total = Conexao::numRows("SELECT * FROM $tabela WHERE 1=1 ".($busca<>'' ? " AND (titulo LIKE '%$busca%')" : "")." ORDER BY codigo DESC");
  $pagina = ceil($total/$max);
  $query = Conexao::fetchAll("SELECT * FROM $tabela WHERE 1=1 ".($busca<>'' ? " AND (titulo LIKE '%$busca%')" : "")." ORDER BY codigo DESC LIMIT $in,$max");
  $pagina=$pagina-1;

  if($acao=="deletar") {
    $delete = Conexao::delete("DELETE FROM $tabela WHERE codigo='$codigo'");
    echo "<div class='alertyes'>Deletado com sucesso!</div>";
    echo "<script>setTimeout(function() {window.location.href='$urldois';}, 3200);</script>";
  }

  if($selecionadosAcao<>'' && $selecionadosAcao=="deletar") {
    foreach($cod_itemSelecionado as $key=>$cod_selecionado) {
      $delete = Conexao::delete("DELETE FROM $tabela WHERE codigo='$cod_selecionado'");
    }
    echo "<script>window.location.href='$urlDeVolta';</script>";
  }

?>

<script type="text/javascript">
  $(document).ready(function() {
    $('#selecionarTudo1').click(function() {
      if(this.checked == true){
        $("input[type=checkbox]").each(function() { 
          this.checked = true; 
        });
      } else {
        $("input[type=checkbox]").each(function() { 
          this.checked = false; 
        });
      }
    });
  });

    function confirmaExclusao() {
        if(confirm('Tem certeza que deseja excluir?')) return true;
        else return false;
    }
</script>

  <div class="span12 margin-l20">
    <a href="index.php?pg=view_cidades" class="btn btn-success pull-left">VOLTAR À CIDADES</a>
    <a href="index.php?pg=edit_bairros&acao=publicar&codcid=<?php echo $codcid;?>" class="marginl20 btn btn-success pull-left">ADD BAIRROS</a>
  </div>  

  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon">
            <input type="checkbox" id="selecionarTudo1" name="selecionarTudo1" id="title-checkbox" />
            </span>
            <h5>Selecionar todos</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped with-check">
              <thead>
                <tr>
                  <th width="2%"><i class="icon-resize-vertical"></i></th>
                  <th width="48%">Titulo</th>
                  <th width="10%">&nbsp;</th>
                  <th width="10%">&nbsp;</th>
                  <th width="20%">Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($query as $chave=>$value){ ?>
                <tr>
                  <td><input type="checkbox" id="cod_itemSelecionado1[]" name="cod_itemSelecionado[]" value="<?php echo $value->codigo; ?>"/></td>
                  <td><?php echo $value->titulo;?></td>
                  <td></td>
                  <td></td>
                  <td class="center">
                    <a href="index.php?pg=view_bairros&acao=deletar&codigo=<?php echo $value->codigo;?>&codcid=<?php echo $codcid;?>" onclick="return confirmaExclusao();"><span class="btn btn-mini btn-danger">Deletar</span></a>
                    <a href="index.php?pg=edit_bairros&acao=editar&codigo=<?php echo $value->codigo;?>&codcid=<?php echo $codcid;?>"><span class="btn btn-mini btn-primary">Editar</span></a>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>

        </div>
        <div class="span12 margin20">
          <div class="row">
            <div class="span3">
              <select id="selecionadosAcao" name="selecionadosAcao" class="form-control">
                <option selected value="0">Escolha uma Opção...&nbsp;&nbsp;</option>
                <option value="deletar">Excluir estes registros</option>
              </select>
            </div>
            <div class="span2">
              <input type="submit" class="btn btn-info" value="Aplicar">
            </div>
          </div>
        </div>

        <div class="span12">
          <div class="row">
            <div class="span5">
              <div class="dataTables_info" id="datatable-keytable_info" role="status" aria-live="polite">Mostrando 1 a <?php echo $max;?> de <?php echo $total;?> publicações.</div>
            </div>

            <div class="span7" <?php echo ($total<=$max ? 'style="display:none;"':""); ?>>
              <div class="pagination alternate" id="datatable-keytable_paginate">
                <ul class="pagination">
                    <?php $menos=$p-1;
                    $mais= $p+1;
                    $quant_pg=ceil($total/$max);
                    if($menos>=0) { ?><li class="paginate_button"><a href="index.php?pg=<?php echo $urlReturn; ?>&p=<?php echo $mais; ?>&codcid=<?php echo $codcid;?>" title="Voltar uma Página!">«</a></li><?php }
                    $anterior  = (($p-4)<1 ? 0 : $p-4);
                    $posterior = (($p+4)>$quant_pg ? $quant_pg-1 : $p+3);
                    for($i=$anterior; $i<=$posterior; $i++) {
                      if($i!=$p) { ?>
                        <li class="paginate_button"><a href="index.php?pg=<?php echo $urlReturn; ?>&p=<?php echo $i; ?>&codcid=<?php echo $codcid;?>" title="Ir para a página <?php echo ($i<10 && $i<>0 ? "0".($i) : ($i==0 ? "Inicial" : $i+1)); ?>!"><?php echo ($i<10 && $i<>0 ? "0".($i) : ($i==0 ? "Inicial" : $i+1)); ?></a></li>
                      <?php } else { ?>
                        <li class="paginate_button <?php echo ($p==$i ? "active" : ""); ?>"><a href="javascript:void(0);"  title="Você está nesta Página!"><?php echo ($i<10 && $i<>0 ? "0".($i) : ($i==0 ? "Inicial" : $i+1)); ?></a></li>
                      <?php }
                    }
                    if($mais<$quant_pg) { ?><li class="paginate_button "><a href="index.php?pg=<?php echo $urlReturn; ?>&p=<?php echo $mais; ?>&codcid=<?php echo $codcid;?>" title="Avançar uma Página!">»</a></li><?php } ?>
                </ul>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>