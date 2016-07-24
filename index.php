
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIGED - Sistema Integrado de Gestão Distrital | MDIO Interact Brasil</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
 <div class="login-box">
  <div class="login-box-body">
   <p class="login-box-msg">
    <img src="dist/img/logo/ICLogo_Azul_Graf.png" width="200">
    <?php
/* login.php */
if (isset($_GET["erro"])) {
  ?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Erro!</h4>
                Não foi possível acessar. <br />
                Erro: <?php echo $_GET["erro"]; ?>
              </div>
<?php

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
          <button type="submit" class="btn btn-facebook btn-block btn-flat">Entrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <a href="#">Esqueci a Senha</a><br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
        <p align="center">
        Copyright &copy; 2015-2016<br /> <b>Interact Brasil</b> - Todos os direitos reservados <br />
        Desenvolvido por Marquistei Medeiros</p>

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="dist/js/bootstrap-notify.js"></script>
<script src="dist/js/demo2.js"></script>

    <script src="dist/js/jquery-1.10.2.js" type="text/javascript"></script>
  <script src="dist/js/bootstrap.min.js" type="text/javascript"></script>

  <!--  Checkbox, Radio & Switch Plugins -->
  <script src="dist/js/bootstrap-checkbox-radio-switch.js"></script>

  <!--  Charts Plugin -->
  <script src="dist/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="dist/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
  <script src="dist/js/light-bootstrap-dashboard.js"></script>

  <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
  <script src="dist/js/demo.js"></script>



</body>
</html>
