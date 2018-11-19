<?php //ini_set('display_errors', 'On');
  $qtdbairros = Conexao::fetchAll("SELECT b.titulo, count(o.qtd_envolvidos) as qtd FROM qs_ocorrencias as o INNER JOIN qs_bairros as b ON o.cod_bairro=b.codigo GROUP BY o.cod_bairro ORDER BY qtd DESC");
?>

<script>
  window.onload = function () {

  var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    theme: "light2", // "light1", "light2", "dark1", "dark2"
    title:{
      text: "Bairros com mais acidentes"
    },
    axisY: {
      title: "Quantidade"
    },
    data: [{        
      type: "column",  
      showInLegend: true, 
      legendMarkerColor: "grey",
      legendText: "Bairros",
      dataPoints: [      
      <?php foreach ($qtdbairros as $cf=>$svalue) {?>
        { y: <?php echo $svalue->qtd;?>, label: "<?php echo $svalue->titulo;?>" },
      <?php } ?>
      ]
    }]
  });
  chart.render();

  }
</script>
<div class="margin20">
<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
</div>
<script src="js/canvasjs.min.js"></script>
