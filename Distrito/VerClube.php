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

$QueryClubes2 = "SELECT * FROM icbr_associado WHERE icbr_AssClubeID='$IDClube'";
$stmt2 = $PDO->prepare($QueryClubes2);
$stmt2->execute();


 $dadosclube = $PDO->prepare("SELECT * FROM icbr_clube WHERE icbr_id='$IDClube'");
      $dadosclube->execute();

          $campo = $dadosclube->fetch();
      $NomeClube = $campo['icbr_Clube'];
      $RotaryPadrinho = $campo['icbr_RotaryPadrinho'];
      $DatadeFundacao = $campo['icbr_DataFundado'];
      $DistritoClube = $campo['icbr_Distrito'];
      $PresidenteClube = $campo['icbr_Presidente'];
      $SecretarioClube = $campo['icbr_Secretario'];
      $TesoureiroClube = $campo['icbr_Tesoureiro'];

      // CHAMA PERIODO DE REUNIÕES

      $ClubeEndereco = $campo['icbr_CEnd'];
      $ClubePeriodo = $campo['icbr_Periodo'];
      $DiaSemana = $campo['icbr_Semana'];
      $HorarioSemana = $campo['icbr_Horario'];
      $EnderecoClube = $campo['icbr_CEnd'];
      $NumeroClube = $campo['icbr_CNum'];
      $BairroClube =  $campo['icbr_Bairro'];
      $CEPClube = $campo['icbr_CEP'];
      $EstadoClube = $campo['icbr_UF'];
      $CidadeClube = $campo['icbr_Cidade'];
      $CodClub = $campo['icbr_id'];
      $StatusClub = $campo['icbr_Status'];

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
            <li class="active"><a href="Clubes.php"><i class="fa fa-industry"></i> Clubes</a></li>
            <li><a href="Associados.php"><i class="fa fa-users"></i> Associados</a></li>
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
            Interact Club de <?php echo $NomeClube; ?>
            <small class="pull-right">Distrito <?php echo $DistritoClube; ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>Clube Patrocinador: </strong><br />
            <?php echo $RotaryPadrinho; ?><br /><br />
            <strong>Data de Fundação: </strong><br />
            <?php echo $DatadeFundacao; ?><br /><br />
            <strong>Código Interact Brasil: </strong><br />
            <?php echo $CodClub; ?><br /><br />
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>Endereço</strong><br>
            <?php echo $EnderecoClube; ?><br />
            Nº.: <?php echo $NumeroClube; ?>, CEP: <?php echo $NumeroClube; ?><br />
            Bairro <?php echo $BairroClube; ?><br />
            <?php echo $CidadeClube . " - " . $EstadoClube; ?><br />
          <br>
          Status do Club<br>
          <?php
          if ($StatusClub == "A") {
          echo '<div class="btn btn-block btn-success">ATIVO</div>';
          }
          elseif ($StatusClub == "D") {
          echo '<div class="btn btn-block btn-danger">DESATIVADO</div>';

          }
          else{
            #
          }
          ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
         <address>
         <?php
          function qrcode($url, $size){
          if($url != "" && $size != ""){
          return "http://chart.apis.google.com/chart?cht=qr&chl=".$url."&chs=".$size."x".$size."";
        }
        }
         ?>
        <img src="<?php echo qrcode("http://interactbrasil.org/clubes/VerClube.php?ID=<?php echo $IDClube; ?>","200"); ?>" />
         </address>
        </div>

        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
         <table id="clubsinativos" class="table table-bordered table-striped table-responsive">
         <h3>Lista de Associados do Clube</h3>
          <thead>
           <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Data de Nascimento</th>
            <th>Cargo</th>
            <th>Data de Posse</th>
            <th></th>
           </tr>
          </thead>
          <tbody>
           <?php while ($user2 = $stmt2->fetch(PDO::FETCH_ASSOC)): ?>
           <tr>
            <td><?php echo $user2['icbr_uid'] ?></td>
            <td><?php echo $user2['icbr_AssNome'] ?></td>
            <td><?php echo $user2['icbr_AssDtNascimento'] ?></td>
            <td><?php echo $user2['icbr_AssCargo'] ?></td>
            <td><?php echo $user2['icbr_DtPosse'] ?></td>
            <td>
             <a href='VerSocio.php?ID=<?php echo $user2['icbr_uid'] ?>' class="btn btn-default btn-sm" target="_blank"><i class="fa fa-search"></i>
             </a>
           </tr>
           <?php endwhile; ?>
          </tbody>
         </table>
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
