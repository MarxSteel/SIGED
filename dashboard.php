<?php
/* AreaRestrita.php */
require("restritos.php"); 
require_once 'init.php';
$PDO = db_connect();

 $query = $PDO->prepare("SELECT * FROM login WHERE login='$login'");
      $query->execute();

          $par = $query->fetch();
            $Distrito = $par['Distrito'];
            $LoginNome = $par['Nome'];
            $LoginCargoDistrito = $par['CargoDistrito'];
            $LoginClube = $par['Clube'];
            $LoginCargoClube = $par['CargoClube'];
            $IDUSer = $par['codLogin'];
            $Foto = $par['Foto'];


//Chamando Privilégios de Página
  $CorrigeProjetos = $par['icProjeto'];


?>
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
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
</head>
<body class="hold-transition skin-blue-light fixed sidebar-mini">
<div class="wrapper">
 <header class="main-header">
  <a href="#" class="logo">
   <span class="logo-mini"><img src="dist/img/logo/ICLogoMin.png" width="45"></span>
   <span class="logo-lg"><img src="dist/img/logo/ICLogo.png" width="200"></span>
  </a>
  <nav class="navbar navbar-static-top">
   <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Minimizar Navegação</span>
   </a>
   <?php include_once 'SideMenu.php'; ?>
   </nav>
  </header>
  <aside class="main-sidebar">
   <section class="sidebar">
    <?php include_once 'InfoBar.php'; ?>
     <ul class="sidebar-menu">
      <li class="header"></li>
      <li class="active"><a href="#"><i class="fa fa-home"></i>Início</a></li>
      <li><a href="MeuPerfil.php"><i class="fa fa-user"></i>Meu Perfil</a></li>
      <li class="treeview">
        <a href="#">
         <i class="fa fa-building"></i> <span>Distrito <?php echo $Distrito; ?></span>
         <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="Distrito/Clubes.php"><i class="fa fa-industry"></i> Clubes</a></li>
            <li><a href="Distrito/Associados.php"><i class="fa fa-users"></i> Associados</a></li>
            <li><a href="Distrito/Secretaria.php"><i class="fa fa-book"></i> Secretaria</a></li>
            <li><a href="Distrito/Tesouraria.php"><i class="fa fa-dollar"></i> Tesouraria</a></li>
          </ul>
        </li>
        <li><a href="Distrito/Projetos.php"><i class="fa fa-archive"></i>Arquivo de Projetos</a></li>
        <li><a href="ImagemPublica.php"><i class="fa fa-download"></i> Material de Apoio</a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Página Inicial
        <small>Distrito <?php echo $Distrito; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
        <li class="active">Distrito <?php echo $Distrito; ?></li>
      </ol>
    </section>
  <section class="content">
    <div class="row">
     <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
       <a href="Distrito/Clubes.php" >
        <span class="info-box-icon btn-primary">
         <i class="fa fa-industry"></i>
        </span>
       </a>
       <div class="info-box-content"><h4>Lista de Clubes</h4>
      </div>
     </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
     <div class="info-box">
      <a href="Distrito/Associados.php" >
       <span class="info-box-icon btn-danger">
        <i class="fa fa-user"></i>
       </span>
      </a>
      <div class="info-box-content"><h4>Lista de Associados</h4></div>
     </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
     <div class="info-box">
      <a href="Distrito/Secretaria.php" >
       <span class="info-box-icon btn-success disabled">
        <i class="fa fa-newspaper-o"></i>
       </span>
      </a>
      <div class="info-box-content"><h4>Secretaria</h4></div>
     </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
     <div class="info-box">
      <a href="Distrito/Tesouraria.php" >
       <span class="info-box-icon bg-black disabled">
        <i class="fa fa-dollar"></i>
       </span>
      </a>
      <div class="info-box-content"><h4>Tesouraria</h4></div>
     </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
     <div class="info-box">
      <a href="ImagemPublica.php" >
       <span class="info-box-icon btn-warning disabled">
        <i class="fa fa-download"></i>
       </span>
      </a>
      <div class="info-box-content"><h4>Material de Apoio</h4></div>
     </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
     <div class="info-box">
      <a href="Distrito/Projetos.php">
       <span class="info-box-icon btn bg-purple">
        <i class="fa fa-archive"></i>
       </span>
      </a>
      <div class="info-box-content">Projetos<h4>Arquivo Nacional</h4></div>
     </div>
    </div>
    <?php
    if ($CorrigeProjetos == "N") {
      //SE E SOMENTE SE CORRIGEPROJETOS FOR N ENTÃO NÃO FAÇA NADA
    }
    elseif ($CorrigeProjetos == "22") {
    echo '
    <div class="col-md-4 col-sm-6 col-xs-12">
     <div class="info-box">
      <a href="icbrasil/Projetos.php">
       <span class="info-box-icon btn bg-purple">
        <i class="fa fa-archive"></i>
       </span>
      </a>
      <div class="info-box-content">INTERACT BRASIL<h4>CORRIGIR PROJETOS</h4></div>
     </div>
    </div>';
    }


    ?>

   </div>






  </section>
  </div>
<?php include_once 'footer.php'; ?>
</div>
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="plugins/fastclick/fastclick.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="dist/js/pages/dashboard.js"></script>
<script src="dist/js/demo.js"></script>
<script src="dist/js/bootstrap-notify.js"></script>
<script src="dist/js/demo2.js"></script>

</body>
</html>
