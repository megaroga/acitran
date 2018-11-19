
<div class="widget-content nopadding">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th width="2%">Nº</th>
        <th width="33%">Titulo</th>
        <th width="20%">Endereço</th>
        <th width="12%">Feridos</th>
        <th width="10%">Mortes</th>
        <th width="10%">Tempo socorro</th>
        <th width="13%">Data</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($tdsEnv as $number => $displayenv) { ?>
      <tr>
        <td><?php echo ($number+1);?></td>
        <td><?php echo $displayenv->titulo;?></td>
        <td><?php echo $displayenv->endereco;?></td>
        <td><?php echo ($displayenv->qtd_envolvidos-$displayenv->qtd_mortes);?></td>
        <td><?php echo $displayenv->qtd_mortes;?></td>
        <td><?php echo $displayenv->tp_socorro;?> minutos</td>
        <td><?php echo $Funcoes::daxCont($displayenv->data_ocorrencia);?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>