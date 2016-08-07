<?php
/* AreaRestrita.php */
require("../restritos.php"); 
require_once '../init.php';
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

//CHAMANDO PRIVILEGIOS
  $EquipeIC = $par['EqpIC'];
  $CorretorProjeto = $par['icProjeto'];



//QUERY DE PROJETOS PENDENTES
 $ChamaProP = "SELECT icbr_pid, pro_id, pro_Nome, pro_ClubNome, pro_Avenida, pro_Status, pro_FileNome FROM icbr_projetos WHERE pro_Distrito='$Distrito'";
 // seleciona os registros
 $QryProP = $PDO->prepare($ChamaProP);
 $QryProP->execute();

//AQUI EU CHAMO OS CLUBES DO MEU DISTRITO
$QueryClubes = "SELECT icbr_id, icbr_Clube FROM icbr_clube WHERE icbr_Distrito='$Distrito'";
// seleciona os registros
$stmt = $PDO->prepare($QueryClubes);
$stmt->execute();
    
//AQUI CHAMA OS CLUBES APROVADOS
$QtProjetosA = "SELECT COUNT(*) AS total FROM icbr_projetos WHERE pro_Distrito='$Distrito' AND pro_Status= 'A'";
$QuantAprovados = $PDO->prepare($QtProjetosA);
$QuantAprovados->execute();
$QntAprovados = $QuantAprovados->fetchColumn();
//AQUI TERMINA A QUERY DE CONTAR OS CLUBES APROVADOS
//AQUI CHAMA OS CLUBES PENDENTES
$QtProjetosP = "SELECT COUNT(*) AS total FROM icbr_projetos WHERE pro_Distrito='$Distrito' AND pro_Status= 'P' OR 'E' ";
$QuantPendentes = $PDO->prepare($QtProjetosP);
$QuantPendentes->execute();
$QntPendentes = $QuantPendentes->fetchColumn();
//AQUI TERMINA A QUERY DE CONTAR OS PROJETOS PENDENTES
//AQUI CHAMA OS CLUBES PENDENTES
$QtProjetosP = "SELECT COUNT(*) AS total FROM icbr_projetos WHERE pro_Distrito='$Distrito' AND pro_Status= 'R' ";
$QuantReprovados = $PDO->prepare($QtProjetosP);
$QuantReprovados->execute();
$QntReprovados = $QuantPendentes->fetchColumn();
//AQUI TERMINA A QUERY DE CONTAR OS PROJETOS PENDENTES






      //Vendo a quantidade de projetos Cadastrados +1
      $ProGeral = "SELECT COUNT(*) AS total FROM icbr_projetos WHERE pro_id IS NOT NULL";
      $stmt_count = $PDO->prepare($ProGeral);
      $stmt_count->execute();
      $ProjGeral = $stmt_count->fetchColumn();
      $IDP = $ProjGeral+1;

      $DtCad = date('d/m/Y H:i:s');

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIGED - Sistema Integrado de Gestão Distrital | MDIO Interact Brasil</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
</head>
<body class="hold-transition skin-blue-light fixed sidebar-mini">
<div class="wrapper">
 <header class="main-header">
  <a href="#" class="logo">
   <span class="logo-mini"><img src="../dist/img/logo/ICLogoMin.png" width="45"></span>
   <span class="logo-lg"><img src="../dist/img/logo/ICLogo.png" width="200"></span>
  </a>
  <nav class="navbar navbar-static-top">
   <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Minimizar Navegação</span>
   </a>
<div class="navbar-custom-menu">
 <ul class="nav navbar-nav">
  <li class="dropdown user user-menu">
   <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <img src="../uploads/<?php echo $Foto; ?>" class="user-image" alt="User Image">
     <span class="hidden-xs"><?php echo $LoginNome; ?></span>
   </a>
   <ul class="dropdown-menu">
    <li class="user-header">
     <img src="../uploads/<?php echo $Foto; ?>" class="img-circle" alt="User Image">
     <p>
      <?php echo $LoginNome . " - " . $LoginCargoDistrito; ?>
      <small>Interact Club de <?php echo $LoginClube . "<br /> Distrito " . $Distrito; ?></small>
     </p>
    </li>
    <li class="user-body">
     <div class="row">
      <div class="col-xs-12 text-left">
      Interact Club de <?php echo $LoginClube; ?><br />
      <strong><?php echo $LoginCargoClube; ?></strong><br />
      </div>
     </div>
    </li>
    <li class="user-footer">
     <div class="pull-left">
      <a href="../MeuPerfil.php" class="btn btn-success btn-flat">Editar perfil</a>
     </div>
     <div class="pull-right">
      <a href="../logout.php" class="btn btn-danger btn-flat">Sair</a>
     </div>
    </li>
   </ul>
  </li>
 </ul>
</div>   </nav>
  </header>
  <aside class="main-sidebar">
   <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../uploads/<?php echo $Foto; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $LoginNome; ?></p>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
        Distrito <?php echo $Distrito; ?><br /><?php echo $LoginCargoDistrito; ?>
        </div>
      </form>     
      <ul class="sidebar-menu">
       <li class="header"></li>
       <li><a href="../dashboard.php"><i class="fa fa-home"></i>Início</a></li>
       <li><a href="../MeuPerfil.php"><i class="fa fa-user"></i>Meu Perfil</a></li>
       <li class="treeview">
        <a href="#">
         <i class="fa fa-building"></i> <span>Distrito <?php echo $Distrito; ?></span>
         <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
         </span>
        </a>
        <ul class="treeview-menu">
         <li><a href="Clubes.php"><i class="fa fa-industry"></i> Clubes</a></li>
         <li><a href="Associados.php"><i class="fa fa-users"></i> Associados</a></li>
         <li><a href="Secretaria.php"><i class="fa fa-book"></i> Secretaria</a></li>
         <li><a href="Tesouraria.php"><i class="fa fa-dollar"></i> Tesouraria</a></li>
        </ul>
       </li>
       <li class="active"><a href="Projetos.php"><i class="fa fa-archive"></i>Arquivo de Projetos</a></li>
       <li><a href="../ImagemPublica.php"><i class="fa fa-download"></i> Material de Apoio</a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <?php
  if ($EquipeIC == "N") {
    echo '
    <section class="content">
     <div class="row">
      <div class="col-md-12">
       <div class="info-box">
        <a data-toggle="modal" data-target="#CadP">
         <span class="info-box-icon bg-orange">
          <i class="fa fa-exclamation"></i>
         </span>
        </a>
        <div class="info-box-content"><br /><h4><strong>Atenção!</strong> Você não tem Privilégios para Acessar a página</h4>
       </div>
      </div>
     </div>
    </section>';
  }
  elseif ($EquipeIC == "22") {

    if ($CorretorProjeto == "N") {
    echo '
    <section class="content">
     <div class="row">
      <div class="col-md-12">
       <div class="info-box">
        <a data-toggle="modal" data-target="#CadP">
         <span class="info-box-icon bg-orange">
          <i class="fa fa-exclamation"></i>
         </span>
        </a>
        <div class="info-box-content"><br /><h4><strong>Atenção!</strong> Você não tem Privilégios para Acessar a página</h4>
       </div>
      </div>
     </div>
    </section>';
  }
  elseif ($CorretorProjeto == "22") {


?>
  <section class="content">
    <div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
     <div class="info-box"><br />
      <img class="img-responsive pull-center" src="../dist/img/logo/ICLogo_Azul_GrafEsp.png" width="300">
     </div>
    </div>
     <div class="col-md-8 col-sm-6 col-xs-12">
      <div class="info-box">
       <div class="info-box-content">
       <h4>
       <strong>Arquivo Nacional de Projetos</strong><br />
       Tela de Correção de Projetos
       </h4>
      </div>
     </div>
    </div>
    </div>
    <div class="row">
    <div class="col-md-12 col-sm-6 col-xs-12">
     <div class="info-box"><br />

     </div>
    </div>
   </div>
 </section>
 <?php 
}
}
?>
  </div>
<?php include_once '../footer.php'; ?>
</div>
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/pages/dashboard.js"></script>
<script src="../dist/js/demo.js"></script>
<script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../plugins/fastclick/fastclick.min.js"></script>
<script>
      $(function () {
        $('#projetos').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
      });
    </script>
</body>
</html>
