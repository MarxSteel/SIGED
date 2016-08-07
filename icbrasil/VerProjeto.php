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




$DataCadastro = date("d/m/Y - h:i:s");
$idProjeto = $_GET['ID'];

$QueryClubes = "SELECT icbr_hpid, p_DtCadastro, p_DtResposta, p_UsrCadastro, p_Pergunta, p_Resposta FROM icbr_historicoprojeto WHERE p_id='$idProjeto'";
// seleciona os registros
$stmt = $PDO->prepare($QueryClubes);
$stmt->execute();


$QueryClubes2 = "SELECT pdf_id, pdf_anp, pdf_nome FROM icbr_pdfold WHERE pdf_anp='$idProjeto'";
// seleciona os registros
$stmt2 = $PDO->prepare($QueryClubes2);
$stmt2->execute();


 $associado = $PDO->prepare("SELECT * FROM icbr_projetos WHERE pro_id='$idProjeto'");
 $associado->execute();
 $campo = $associado->fetch();
      $NomeProjeto = $campo['pro_Nome'];
      $Avenida = $campo['pro_Avenida'];
      $CodProjeto = $campo['pro_id'];
      $CodClube = $campo['pro_ClubID'];
      $NomeClube = $campo['pro_ClubNome'];
      $DataCadastro = $campo['pro_DtCadastro'];
      $ChamaStatus = $campo['pro_Status'];
      $File = $campo['pro_FileNome'];
      $PDF = "../Distrito/arquivo/" . $File;

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
    
        <section class="content-header">
     <div class="box box-default">
      <div class="box-body">
       <div class="box box-primary">
        <div class="box-body box-profile">
         <div class="col-xs-12">
          <h2 class="profile-username text-center"><?php echo "[" . $Avenida . "] - " . $NomeProjeto; ?></h2>
        </div>
       <div class="col-xs-5">
         <li class="list-group-item">
          <b>Código ANP:</b> 
          <a class="pull-right"><strong><code><?php echo $CodProjeto; ?></code></strong></i></a>
         </li>
         <li class="list-group-item">Interact Club de  <?php echo $NomeClube; ?></li>
         <li class="list-group-item">
          <b>Código do Club:</b>
          <a class="pull-right"><strong><code><?php echo $CodClube; ?> </code></strong></a>
         </li>
         <li class="list-group-item"><b>Cadastro:</b> <a class="pull-right"><?php echo $DataCadastro; ?> </i></a></li>

       </div>
       <div class="col-xs-4">
       <?php
        if ($ChamaStatus == "P") 
        {
        ?>
        <li class="list-group-item">
         <a class="btn btn-flat btn-block btn-warning btn-xs">PENDENTE</a>
        </li>
        <li class="list-group-item">--</li>    
        <li class="list-group-item"><b>Abrir PDF</b>
         <a class="pull-right">
          <span class="btn bg-navy btn-xs" onclick="window.open('<?php echo $PDF; ?>');">Visualizar</span>
         </a>
        </li>   
        <li class="list-group-item">--</li>   


        <?php
        }
        elseif ($ChamaStatus == "A") 
        {
          echo '<li class="list-group-item">';
          echo '<a class="btn btn-flat btn-block btn-success btn-xs">Aprovado</a>';
          echo '</li>';
          echo '<li class="list-group-item">--</li>';
          echo '<li class="list-group-item">--</li>';
          echo '<li class="list-group-item"><b>Abrir PDF</b>';

          ?>
           <a class="pull-right">
            <span class="btn bg-navy btn-xs" onclick="window.open('<?php echo $PDF; ?>');">Visualizar</span>
           </a>
          </li>  
          <?php
        }
        elseif ($ChamaStatus == "E") 
        {
        ?>
        <li class="list-group-item">
         <a class="btn btn-flat btn-block btn-primary btn-xs">AGUARDANDO REVISÃO</a>
        </li>
        <li class="list-group-item">--</li>    
        <li class="list-group-item"><b>Abrir PDF</b>
         <a class="pull-right">
          <span class="btn bg-navy btn-xs" onclick="window.open('<?php echo $PDF; ?>');">Visualizar</span>
         </a>
        </li>   
        <li class="list-group-item"><b>Historico de Arquivos</b>
         <a class="pull-right">
          <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal">
             Visualizar
          </button>   
          <!-- Modal -->
           <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
             <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><code>&times;</code></button>
                 <h4 class="modal-title">Lista de Arquivos Enviados</h4>
              </div>
              <div class="modal-body">
              <table id="example1" class="table table-bordered table-striped">
               <thead>
                <tr>
                 <th>ID</th>
                 <th>Cod. ANP</th>
                 <th></th>        
                </tr>
               </thead>
               <tbody>
                <?php while ($user2 = $stmt2->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                 <td><?php echo $user2['pdf_id'] ?></td>
                 <td><?php echo $user2['pdf_anp'] ?></td>
                  <?php 
                  $ValorPDF = $user2['pdf_nome'];
                  $ValorPDF = "arquivo/" . $ValorPDF;
                  ?>
                 <td><span class="btn bg-olive btn-xs" onclick="window.open('<?php echo $ValorPDF; ?>');">Visualizar</span>
                </tr>
                <?php endwhile; ?>
               </tbody>
              </table>
              </div>
              <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
              </div>
             </div>
            </div>
           </div> 
         </a>
        </li> 


        <?php
        }
    ?>
       </div>
       <div class="col-xs-3">
       <?php  
        $qrcode = 'http://chart.apis.google.com/chart?cht=qr&chl="http://interactbrasil.org/projetos/verprojeto.php?ID=' . $idProjeto . '"&chs=180x180';
        echo "<img src='$qrcode'/>";
       ?>
       <br />
       </div>
      </div><!-- /.box -->
      <div class="box box-primary">
       <div class="box-body box-profile">
        <h2 class="profile-username text-center">Histórico do Projeto</h2>
       </div><!-- /.box -->
       <table id="example1" class="table table-bordered table-striped">
        <thead>
         <tr>
          <th>ID</th>
          <th>Data da Ocorrencia</th>
          <th>Usuario Cadastrado</th>
          <th>Observação</th>
          <th>Resposta</th>
         </tr>
        </thead>
        <tbody>
        <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
         <tr>

          <td><?php echo $user['icbr_hpid'] ?></td>
          <td><?php echo $user['p_DtCadastro'] ?></td>
          <td><?php echo $user['p_UsrCadastro'] ?></td>
          <td><?php echo $user['p_Pergunta'] ?></td>
          <?php
          $DataResposta = $user['p_DtResposta'];
          if (is_null($DataResposta)) 
          {
            $idPergunta = $user['icbr_hpid'];
          ?>
          <td>
          <span class="btn btn-primary btn-block btn-xs" onclick="window.open('RespondeProjeto.php?ID=<?php echo $idPergunta; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=800, HEIGHT=650');">Responder Pendencia</span>
          </td>
          <?php
          }
          else
          {
            echo "<td>" . $user['p_Resposta'] . "</td>";
          }
          ?>
         </tr>
                         <?php endwhile; ?>

        </tbody>
        </table>
      </div><!-- /.box-body -->
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
