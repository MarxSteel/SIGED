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

//QUERY DE PROJETOS GERAL
 $ChamaProP = "SELECT * FROM icbr_projetos WHERE icbr_Gestao='$GVigente'";
 // seleciona os registros
 $QryProP = $PDO->prepare($ChamaProP);
 $QryProP->execute();

//QUERY DE PROJETOS COM APROVADOS
 $ChamaAprovados = "SELECT * FROM icbr_projetos WHERE icbr_Gestao='$GVigente' AND pro_Status='A'";
 // seleciona os registros
 $QryAprovados = $PDO->prepare($ChamaAprovados);
 $QryAprovados->execute();

 //QUERY DE PROJETOS COM PROJETOS AGUARDANDO APROVAÇÃO
 $ChamaAguardando = "SELECT * FROM icbr_projetos WHERE icbr_Gestao='$GVigente' AND pro_Status='E'";
 // seleciona os registros
 $QryEnviados = $PDO->prepare($ChamaAguardando);
 $QryEnviados->execute();

//QUERY DE PROJETOS COM PENDENCIAS
 $ChamaPendentes = "SELECT * FROM icbr_projetos WHERE icbr_Gestao='$GVigente' AND pro_Status='P'";
 // seleciona os registros
 $QryPendentes = $PDO->prepare($ChamaPendentes);
 $QryPendentes->execute();

 //QUERY DE PROJETOS REPROVADOS
 $ChamaReprovados = "SELECT * FROM icbr_projetos WHERE icbr_Gestao='$GVigente' AND pro_Status='R'";
 // seleciona os registros
 $QryReprovados = $PDO->prepare($ChamaReprovados);
 $QryReprovados->execute();

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
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
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
      <div class="nav-tabs-custom">
       <ul class="nav nav-tabs">
        <li class="active"><a href="#todos" data-toggle="tab">Todos</a></li>
        <li><a href="#AguardandoRevisao" data-toggle="tab">Aguardando Revisão</a></li>
        <li><a href="#Aprovados" data-toggle="tab">Aprovados</a></li>
        <li><a href="#Pendentes" data-toggle="tab">Pendentes</a></li>
        <li><a href="#Reprovados" data-toggle="tab">Reprovados</a></li>
       </ul>
       <div class="tab-content">
        <div class="tab-pane active" id="todos">
        <strong>Todos os projetos da gestão: <?php echo $GVigente; ?></strong>
         <table id="example2" class="table table-bordered table-striped table-responsive">
          <thead>
           <tr>
            <th>ID</th>
            <th>Distrito/Clube</th>
            <th>Nome do Projeto</th>
            <th>Avenida</th>
            <th>Status</th>
            <th></th><!-- VAZIO: AQUI ENTRA BOTÕES DE VISUALIZAR E RESOLVER -->
           </tr>
          </thead>
          <tbody>
           <?php while ($pAtivo = $QryProP->fetch(PDO::FETCH_ASSOC)):
           echo "<tr>";
           echo "<td>" . $pAtivo['pro_id'] . "</td>";
           echo "<td>[<code>" . $pAtivo['pro_Distrito'] . "</code>] Interact Club de " . $pAtivo['pro_ClubNome'] . "</td>";
           echo "<td>" . $pAtivo['pro_Nome'] . "</td>";
           echo "<td>" . $pAtivo['pro_Avenida'] . "</td>";
            $MeuStatus = $pAtivo['pro_Status'];
            $idProjeto = $pAtivo['pro_id'];
           if ($MeuStatus == "E") {
            echo '<td>';
            echo '<a class="btn btn-block btn-primary btn-sm ">AGUARDANDO REVISÃO</a>';
            echo '</td>';
            
           }
           elseif ($MeuStatus == "P") {
            echo "<td>";
            echo '<a class="btn btn-block btn-warning btn-sm ">PENDENTE</a>';
            echo "</td>";
           }
           elseif ($MeuStatus == "A") {
            echo "<td>";
            echo '<a class="btn btn-block btn-success btn-sm ">APROVADO</a>';
            echo "</td>";
           }
           elseif ($MeuStatus == "R") {
            echo "<td>";
            echo '<a class="btn btn-block btn-danger btn-sm ">REPROVADO</a>';
            echo "</td>";
           }
           else{
            echo "<td></td>";
            
           }
           echo '<td>';
           echo '<a href="VerProjeto.php?ID=' . $idProjeto . '" class="btn btn-default btn-sm" target="_blank"><i class="fa fa-search"></i></a>';
           echo '</td>';
           echo "<tr>";
           endwhile;
           ?>
          </tbody>
         </table>





        </div>
        <div class="tab-pane" id="AguardandoRevisao">
         <table id="aguardando" class="table table-bordered table-striped table-responsive">
          <thead>
           <tr>
            <th>ID</th>
            <th>Distrito/Clube</th>
            <th>Nome do Projeto</th>
            <th>Avenida</th>
            <th></th><!-- VAZIO: AQUI ENTRA BOTÕES DE VISUALIZAR E RESOLVER -->
           </tr>
          </thead>
          <tbody>
           <?php while ($pEnv = $QryEnviados->fetch(PDO::FETCH_ASSOC)):
           echo "<tr>";
           echo "<td>" . $pEnv['pro_id'] . "</td>";
           echo "<td>[<code>" . $pEnv['pro_Distrito'] . "</code>] Interact Club de " . $pEnv['pro_ClubNome'] . "</td>";
           echo "<td>" . $pEnv['pro_Nome'] . "</td>";
           echo "<td>" . $pEnv['pro_Avenida'] . "</td>";
            $MeuStatus = $pEnv['pro_Status'];
            $idProjeto = $pEnv['pro_id'];
           echo '<td>';
           echo '<a href="VerProjeto.php?ID=' . $idProjeto . '" class="btn btn-default btn-sm" target="_blank"><i class="fa fa-search"></i></a>&nbsp;';
           echo '<a href="RevisarProjeto.php?ID=' . $idProjeto . '" class="btn bg-orange btn-sm" target="_blank"><i class="fa fa-repeat"> Revisar</i></a>';
           echo '</td>';
           echo "<tr>";
           endwhile;
           ?>
          </tbody>
         </table>  
        </div>
        <div class="tab-pane" id="Aprovados">
        <strong>Todos os projetos APROVADOS da gestão: <?php echo $GVigente; ?></strong>
         <table id="aprovados" class="table table-bordered table-striped table-responsive">
          <thead>
           <tr>
            <th>ID</th>
            <th>Distrito/Clube</th>
            <th>Nome do Projeto</th>
            <th>Avenida</th>
            <th></th><!-- VAZIO: AQUI ENTRA BOTÕES DE VISUALIZAR E RESOLVER -->
           </tr>
          </thead>
          <tbody>
           <?php while ($pAp = $QryAprovados->fetch(PDO::FETCH_ASSOC)):
           echo "<tr>";
           echo "<td>" . $pAp['pro_id'] . "</td>";
           echo "<td>[<code>" . $pAp['pro_Distrito'] . "</code>] Interact Club de " . $pAp['pro_ClubNome'] . "</td>";
           echo "<td>" . $pAp['pro_Nome'] . "</td>";
           echo "<td>" . $pAp['pro_Avenida'] . "</td>";
            $MeuStatus = $pAp['pro_Status'];
            $idProjeto = $pAp['pro_id'];
           echo '<td>';
           echo '<a href="VerProjeto.php?ID=' . $idProjeto . '" class="btn btn-default btn-sm" target="_blank"><i class="fa fa-search"></i></a>';
           echo '</td>';
           echo "<tr>";
           endwhile;
           ?>
          </tbody>
         </table>
        </div>
        <div class="tab-pane" id="Pendentes">
        <strong>Todos os projetos PENDENTES da gestão: <?php echo $GVigente; ?></strong>
         <table id="pendentes" class="table table-bordered table-striped table-responsive">
          <thead>
           <tr>
            <th>ID</th>
            <th>Distrito/Clube</th>
            <th>Nome do Projeto</th>
            <th>Avenida</th>
            <th></th><!-- VAZIO: AQUI ENTRA BOTÕES DE VISUALIZAR E RESOLVER -->
           </tr>
          </thead>
          <tbody>
           <?php while ($pPen = $QryPendentes->fetch(PDO::FETCH_ASSOC)):
           echo "<tr>";
           echo "<td>" . $pPen['pro_id'] . "</td>";
           echo "<td>[<code>" . $pPen['pro_Distrito'] . "</code>] Interact Club de " . $pPen['pro_ClubNome'] . "</td>";
           echo "<td>" . $pPen['pro_Nome'] . "</td>";
           echo "<td>" . $pPen['pro_Avenida'] . "</td>";
            $MeuStatus = $pPen['pro_Status'];
            $idProjeto = $pPen['pro_id'];
           echo '<td>';
           echo '<a href="VerProjeto.php?ID=' . $idProjeto . '" class="btn btn-default btn-sm" target="_blank"><i class="fa fa-search"></i></a>';
           echo '</td>';
           echo "<tr>";
           endwhile;
           ?>
          </tbody>
         </table>        
        </div>
        <div class="tab-pane" id="Reprovados">
        <strong>Todos os projetos PENDENTES da gestão: <?php echo $GVigente; ?></strong>
         <table id="reprovados" class="table table-bordered table-striped table-responsive">
          <thead>
           <tr>
            <th>ID</th>
            <th>Distrito/Clube</th>
            <th>Nome do Projeto</th>
            <th>Avenida</th>
            <th></th><!-- VAZIO: AQUI ENTRA BOTÕES DE VISUALIZAR E RESOLVER -->
           </tr>
          </thead>
          <tbody>
           <?php while ($pRep = $QryReprovados->fetch(PDO::FETCH_ASSOC)):
           echo "<tr>";
           echo "<td>" . $pRep['pro_id'] . "</td>";
           echo "<td>[<code>" . $pRep['pro_Distrito'] . "</code>] Interact Club de " . $pRep['pro_ClubNome'] . "</td>";
           echo "<td>" . $pRep['pro_Nome'] . "</td>";
           echo "<td>" . $pRep['pro_Avenida'] . "</td>";
            $MeuStatus = $pRep['pro_Status'];
            $idProjeto = $pRep['pro_id'];
           echo '<td>';
           echo '<a href="VerProjeto.php?ID=' . $idProjeto . '" class="btn btn-default btn-sm" target="_blank"><i class="fa fa-search"></i></a>';
           echo '</td>';
           echo "<tr>";
           endwhile;
           ?>
          </tbody>
         </table>                    
        </div>
       </div>
      </div>
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
    $("#todos").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
</body>
</html>
