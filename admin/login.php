<!DOCTYPE html>
<?php 
session_start();
include("../conexao/connection.php");
date_default_timezone_set('America/Cuiaba');

?>
<html lang="pt_BR">
<head>
        <title>Admin</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="../css/matrix-login.css" />
        <link rel="stylesheet" href="../css/index.css" />
        <link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <?php
            if($_POST['envlogin']=='sim'){
                $senha = md5(md5($_POST['email'].$_POST['senha']));
                $logar = Conexao::fetch("SELECT codigo, nome FROM qs_usuarios WHERE email='$_POST[email]' AND senha='$senha'");
                if(!empty($logar)){
                    $_SESSION['codUSUARIO'] = $logar->codigo;
                    $_SESSION['nomeUSUARIO'] = $logar->nome;
                    echo "<div class='alertyes'>Login efetuado com sucesso!</div>";
                    echo "<script>setTimeout(function() {window.location.href='index.php';}, 3200);</script>";
                }else{
                    echo "<div class='alertyes'>Erro ao logar, tente novamente por favor!</div>";
                    echo "<script>setTimeout(function() { window.location.href='login.php'; }, 2500);</script>";
                }
            }
        ?>
        <div id="loginbox">            
            <form id="loginform" class="form-vertical" action="login.php" method="post">
                 <input type="hidden" name="envlogin" value="sim">
				 <div class="control-group normal_text"> <h3><img src="img/logo.png" alt="Logo" /></h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" name="email" placeholder="Email" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" name="senha" placeholder="Senha" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-right"><input type="submit" class="btn btn-success" value="Login"></span>
                </div>
            </form>
        </div>
        
        <script src="../js/jquery.min.js"></script>  
        <script src="../js/matrix.login.js"></script> 
    </body>

</html>
