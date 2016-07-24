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
$QueryClubes = "SELECT icbr_id, icbr_Clube, icbr_Presidente, icbr_Semana, icbr_Periodo, icbr_Horario FROM icbr_clube WHERE icbr_Distrito='$Distrito' AND icbr_Status='A' ORDER BY icbr_Clube ASC";
$stmt = $PDO->prepare($QueryClubes);
$stmt->execute();

$QueryClubes2 = "SELECT icbr_id, icbr_Clube, icbr_Presidente, icbr_Semana, icbr_Periodo, icbr_Horario FROM icbr_clube WHERE icbr_Distrito='$Distrito' AND icbr_Status='D' ORDER BY icbr_Clube ASC";
$stmt2 = $PDO->prepare($QueryClubes2);
$stmt2->execute();

$DataCadastro = date("d/m/Y - h:i:s");

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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cadastro de Clubs
        <small>Distrito <?php echo $Distrito; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
        <li>Distrito <?php echo $Distrito; ?></li>
        <li class="active">Clubs do Distrito</li>
      </ol>
    </section>
  <section class="content">
    <div class="row">
     <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
       <a data-toggle="modal" data-target="#NovoClub">
        <span class="info-box-icon btn-primary">
         <i class="fa fa-plus"></i>
        </span>
       </a>
       <div class="info-box-content"><br /><h4>Adicionar Club</h4>
      </div>
     </div>
    </div>
    <div class="col-md-5 col-sm-5 col-xs-12">
     <div class="info-box"><br />
     </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
     <div class="info-box"><br />
      <img class="img-responsive pull-center" src="../dist/img/logo/ICLogo_Azul_GrafEsp.png" width="300">
     </div>
    </div>
    <div class="col-md-12 col-sm-6 col-xs-12">
     <div class="info-box"><br />
      <div class="nav-tabs-custom">
       <ul class="nav nav-tabs pull-right">
        <li class="active"><a href="#Ativos" data-toggle="tab">Clubes Ativos</a></li>
        <li><a href="#Inativos" data-toggle="tab">Clubes Inativos</a></li>
        <li class="pull-left header">LISTA DE CLUBS</li>
       </ul>
       <div class="tab-content">
        <div class="tab-pane active" id="Ativos">
         <table id="clubsativos" class="table table-responsive table-bordered table-striped">
          <thead>
           <tr>
            <th>ID</th>
            <th>Interact Club de:</th>
            <th>Reuniões</th>
            <th>Presidente</th>
            <th></th>
           </tr>
          </thead>
          <tbody>
           <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
           <tr>
            <td><?php echo $user['icbr_id'] ?></td>
            <td><?php echo $user['icbr_Clube'] ?></td>
            <td><?php echo $user['icbr_Semana'] . ' - ' . $user['icbr_Horario'] . ' (' . $user['icbr_Periodo'] . ')';?></td>
            <td><?php echo $user['icbr_Presidente'] ?></td>
            <td>
             <a href='VerClube.php?ID=<?php echo $user['icbr_id'] ?>' class="btn btn-default btn-sm" target="_blank"><i class="fa fa-search"></i>
             </a>
             <span class="btn btn-danger btn-sm" onclick="window.open('DesCl.php?ID=<?php echo $user['icbr_id'] ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=800, HEIGHT=650');"><i class="fa fa-close"></i></span>
            </td>
           </tr>
           <?php endwhile; ?>
          </tbody>
         </table>
        </div>
        <div class="tab-pane" id="Inativos">
         <table id="clubsinativos" class="table table-bordered table-striped">
          <thead>
           <tr>
            <th>ID</th>
            <th>Interact Club de:</th>
            <th>Reuniões</th>
            <th>Presidente</th>
            <th></th>
           </tr>
          </thead>
          <tbody>
           <?php while ($user2 = $stmt2->fetch(PDO::FETCH_ASSOC)): ?>
           <tr>
            <td><?php echo $user2['icbr_id'] ?></td>
            <td><?php echo $user2['icbr_Clube'] ?></td>
            <td><?php echo $user2['icbr_Semana'] . ' - ' . $user2['icbr_Horario'] . ' (' . $user2['icbr_Periodo'] . ')';?></td>
            <td><?php echo $user2['icbr_Presidente'] ?></td>
            <td>
             <a href='VerClube.php?ID=<?php echo $user2['icbr_id'] ?>' class="btn btn-default btn-sm" target="_blank"><i class="fa fa-search"></i>
             </a>
             <span class="btn btn-success btn-sm" onclick="window.open('AtCl.php?ID=<?php echo $user2['icbr_id'] ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=800, HEIGHT=650');"><i class="fa fa-check-circle"></i></span>
            </td>
           </tr>
           <?php endwhile; ?>
          </tbody>
         </table>
        </div>
        <div class="modal fade" id="NovoClub" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
          <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <code><span aria-hidden="true">&times;</span></code>
            </button>
            <h4 class="modal-title" id="myModalLabel">Adicionando Club</h4>
           </div>
           <div class="modal-body">
            <div class="col-xs-12">
             <form name="trocarFoto" id="name" method="post" action="" enctype="multipart/form-data">
              <div class="col-xs-4">Data de Cadastro
               <input type="text" class="form-control" id="ordem" name="ordem" disabled placeholder="<?php echo $DataCadastro; ?>">
              </div>
              <div class="col-xs-4">Data de fundação
               <input type="text" class="form-control" id="DtFundacao" name="DtFundacao" minlength="10" maxlength="10" placeholder="DD/MM/AAAA">
              </div>
              <div class="col-xs-4">Distrito
               <input type="text" class="form-control" disabled placeholder="Distrito <?php echo $Distrito; ?>">
              </div>
              <div class="col-xs-12">Interact Club de
               <input type="text" id="ic" name="ic" class="form-control" required="required">
              </div>
              <div class="col-xs-12">Clube Patrocinador
               <input type="text" id="rc" name="rc" class="form-control" required="required" placeholder="Rotary Clube de Curitiba Norte">
              </div><br /><br /><br /><br /><br /><br /><br />
              <div>
               <br /><br />
               <input name="enviar" type="submit" class="btn btn-primary" id="enviar" value="Cadastrar" />
               <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
              </div>
             </form>
             <?php
              if(@$_POST["enviar"])
              {
               $DataFundacao = $_POST['DtFundacao'];
               $Interact = $_POST['ic'];
               $Rotary = $_POST['rc'];
               $Sc = "Não Cadastrado";
              
                //EXECUTANDO QUERY
               $executa = $PDO->query("INSERT INTO icbr_clube (icbr_Clube, icbr_DataFundado, icbr_Distrito, icbr_RotaryPadrinho, icbr_Status) VALUES ('$Interact', '$DataFundacao', '$Distrito', '$Rotary', 'A')");
               if($executa)
               {
                echo '
                 <script type="text/JavaScript">
                  alert("Clube Cadastrado!");
                  location.href="Clubes.php"
                 </script>';
               }
               else
               {
                echo '<script type="text/javascript">alert("! <?php print_r($PDO->errorInfo()); ?>");</script>';
               }
              }
             ?>




            </div>
           </div>
           <div class="modal-footer"></div>
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
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
