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

// AQUI DECLARO A QUERY DE DADOS DOS CLUBES:



$IDClube = $_GET['ID'];


 $dadosclube = $PDO->prepare("SELECT * FROM icbr_associado WHERE icbr_uid='$IDClube'");
      $dadosclube->execute();

          $campo = $dadosclube->fetch();
      $NomeCompleto = $campo['icbr_AssNome'];
      $DistritoSocio = $campo['icbr_AssDistrito'];
      $ClubeSocio = $campo['icbr_AssClube'];
      $IDClubeSocio = $campo['icbr_AssClubeID'];
      $CargoSocio = $campo['icbr_AssCargo'];
      $DataPosseSocio = $campo['icbr_DtPosse'];
      $DataNascimentoSocio = $campo['icbr_AssDtNascimento'];
      $StatusSocio = $campo['icbr_AssStatus'];
      $FotoSocio = $campo['icbr_AssFoto'];

      //CHAMANDO ENDEREÇO DO ASSOCIADO
      $RuaSocio = $campo['icbr_AssEndereco']; 
      $NumSocio = $campo['icbr_AssNum']; 
      $BairroSocio = $campo['icbr_AssBairro']; 
      $CidadeSocio = $campo['icbr_AssCidade']; 
      $UFSocio = $campo['icbr_AssUF']; 
      $CEPSocio = $campo['icbr_AssCEP']; 
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<script>
function limpa() {
if(document.getElementById('foto').value!="") {
document.getElementById('foto').value="";
}
}
</script>
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
     <img src="uploads/<?php echo $Foto; ?>" class="img-circle" alt="User Image">
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
      </form>     <ul class="sidebar-menu">
      <li class="header"></li>
      <li><a href="../dashboard.php"><i class="fa fa-home"></i>Início</a></li>
      <li><a href="../MeuPerfil.php"><i class="fa fa-user"></i>Meu Perfil</a></li>
      <li class="active treeview">
        <a href="#">
         <i class="fa fa-building"></i> <span>Distrito <?php echo $Distrito; ?></span>
         <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="Clubes.php"><i class="fa fa-industry"></i> Clubes</a></li>
            <li class="active"><a href="Associados.php"><i class="fa fa-users"></i> Associados</a></li>
            <li><a href="Secretaria.php"><i class="fa fa-book"></i> Secretaria</a></li>
            <li><a href="Tesouraria.php"><i class="fa fa-dollar"></i> Tesouraria</a></li>
          </ul>
        </li>
        <li><a href="Projetos.php"><i class="fa fa-archive"></i>Arquivo de Projetos</a></li>
        <li><a href="../ImagemPublica.php"><i class="fa fa-download"></i> Material de Apoio</a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <?php echo $NomeCompleto; ?>
            <small class="pull-right">Distrito <?php echo $DistritoSocio; ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>Interact Club de: </strong><br />
            <?php echo $ClubeSocio . " (ID: " . $IDClubeSocio . ")"; ?><br />
            <i><?php echo $CargoSocio; ?></i><br /><br />
            <strong>Data de Posse: </strong><br />
            <?php echo $DataPosseSocio; ?><br /><br />
            <strong>Data de Nascimento: </strong><br />
            <?php echo $DataNascimentoSocio; ?><br /><br />
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <address> 
            <strong>Endereço</strong><br>
            <?php echo $RuaSocio; ?><br />
            Nº.: <?php echo $NumSocio; ?>, CEP: <?php echo $CEPSocio; ?><br />
            Bairro <?php echo $BairroSocio; ?><br />
            <?php echo $CidadeSocio . " - " . $UFSocio; ?><br />
          <br>
          Status do Club<br>
          <?php
          if ($StatusSocio == "A") {
          echo '<div class="btn btn-block btn-success disabled">ATIVO</div>';
          }
          elseif ($NomeCompleto == "I") {
          echo '<div class="btn btn-block btn-danger">INATIVO</div>';

          }
          else{
            #
          }

          ?>
       </div>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
         <address>
          <img src="../uploads/<?php echo $FotoSocio; ?>" class="user-image" width="200" alt="User Image">
         </address>
        </div>

        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
        </div>
        <!-- /.col -->
      </div>
    </section>

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
        $('#clubsativos').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
        $('#clubsinativos').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
      });
    </script>




</body>
</html>
