<?php //ini_set('display_errors', 'On');
include("./conexao/connection.php");

date_default_timezone_set('America/Cuiaba');

include("./conexao/funcoes.php");
$Funcoes = new Funcoes;

?>

<?php $countdos = "SELECT titulo,endereco,coord,qtd_envolvidos,qtd_mortes,tp_socorro,data_ocorrencia,cod_bairro FROM qs_ocorrencias WHERE 1=1 ORDER BY data_ocorrencia DESC";?>
<?php $countEnv = Conexao::numRows($countdos);?>
<?php $tdsEnv = Conexao::fetchAll($countdos);?>
<?php foreach ($tdsEnv as $key => $val) {
  $qtdenv+= $val->qtd_envolvidos-$val->qtd_mortes;
  $qtmorte+= $val->qtd_mortes;
  $tp_socorrom+= $val->tp_socorro;
} $qtdmedia = $tp_socorrom/$countEnv;
?>


<!DOCTYPE html>
<html lang="pt_BR">
<head>
<title>Acidentes de trânsito</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/fullcalendar.css" />
<link rel="stylesheet" href="css/matrix-style.css" />
<link rel="stylesheet" href="css/matrix-media.css" />
<link rel="stylesheet" href="css/index.css" />
<link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="">Acidentes de trânsito</a></h1>
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li class=""><a title="Logar" href="index.php"><span class="text">Home</span></a></li>
    <li class=""><a title="Logar" href="admin"><i class="icon icon-cog"></i> <span class="text">admin</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<!-- <div id="search">
  <input type="text" placeholder="Search here..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div> -->
<!--close-top-serch-->
<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li class="activeA"><a href="index.php"><i class="icon icon-home"></i> <span>Home </span></a> </li>
    <li class="activeA"><a href="javascript:void(0);" onclick="getLocation()"><i class="icon icon-map-marker"></i> <span>Mostrar perto de mim </span></a> </li>
    <li> <a href="index.php?pg=lista"><i class="icon icon-tasks"></i> <span>Lista de acidentes</span></a> </li>
    <li> <a href="index.php?pg=graficos"><i class="icon icon-signal"></i> <span>Gráficos</span></a> </li>

    <li class="content"> <span>Informações</span>
      <div class="stat">Total de acidentes: <?php echo $countEnv;?></div>
      <div class="stat">Feridos: <?php echo $qtdenv;?></div>
      <div class="stat">Mortes: <?php echo $qtmorte;?></div>
      <div class="stat">Média tempo socorro: <?php echo $qtdmedia;?> min.</div>
    </li>
    <li class="content"> <span align="center">Sinop</span>
      <div class="stat"><img src="img/sinop.jpg" class="img-responsive"></div>
    </li>
  </ul>
</div>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Mapa de acidentes de trânsito (<?php echo $countEnv;?>)</a></div>
  </div>
<!--End-breadcrumbs-->

  <?php $no = array("www", "http://"); $yes = array("%#shaush#%", "%#okoko#%");
  $filtro = str_replace($no, $yes, $_GET['pg']);
  if(isset($_GET['pg'])) { 
  $page = $filtro.".php"; include($page);
  } else {
  require_once("capa.php");
  } ?>

</div>

<!--end-main-container-part-->

<!--Footer-part-->

<div class="row-fluid">
  <div id="footer" class="span12"> <?php echo date('Y')?> &copy; desenvolvido por Rodolfo Medina García </div>
</div>

<!--end-Footer-part-->

<script src="js/excanvas.min.js"></script> 
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.peity.min.js"></script> 
<script src="js/fullcalendar.min.js"></script> 
<!-- <script src="js/jquery.gritter.min.js"></script>  -->
<!-- <script src="js/matrix.interface.js"></script>  -->
<script src="js/matrix.chat.js"></script> 
<script src="js/jquery.validate.js"></script> 
<script src="js/matrix.form_validation.js"></script> 
<script src="js/jquery.wizard.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/matrix.popover.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.tables.js"></script> 

<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
</html>
