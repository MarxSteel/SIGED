<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title>SIGED - Sistema Integrado de Gestão Distrital | MDIO Interact Brasil</title>
 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
 <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
 <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
</head>
<body class="hold-transition login-page">
 <div class="login-box">
  <div class="login-box-body">
   <p class="login-box-msg">
    <img src="dist/img/logo/ICLogo_Azul_Graf.png" width="200">
    <?php
    if (isset($_GET["erro"])) {
      echo '<div class="alert alert-danger alert-dismissible">';
      echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
      echo '<h4><i class="icon fa fa-ban"></i> Erro!</h4>';
      echo 'Não foi possível acessar. <br />';
      echo 'Erro: ' . $_GET["erro"];
      echo '</div>';
    }
    ?>
   </p>
    <form action="logar.php" name="login" method="post" enctype="multipart/form-data">
     <div class="form-group has-feedback">
      <input type="text" name="login" class="form-control" placeholder="Usuário">
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
     </div>
     <div class="form-group has-feedback">
      <input type="password" name="senha" class="form-control" placeholder="Senha">
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
     </div>
     <div class="row">
      <div class="col-xs-12">
       <button type="submit" class="btn btn-facebook btn-block btn-flat">Acessar</button>
      </div>
     </div>
    </form>
    <a href="#">Esqueci a Senha</a><br>
  </div>
 </div>
 <p align="center">
 Copyright &copy; 2015-2016<br /> <b>Interact Brasil</b> - Todos os direitos reservados <br />
 Desenvolvido por Marquistei Medeiros</p>
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="dist/js/bootstrap-notify.js"></script>
<script src="dist/js/demo2.js"></script>
<script src="dist/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="dist/js/bootstrap-checkbox-radio-switch.js"></script>
<script src="dist/js/chartist.min.js"></script>
<script src="dist/js/bootstrap-notify.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script src="dist/js/light-bootstrap-dashboard.js"></script>
<script src="dist/js/demo.js"></script>



</body>
</html>
