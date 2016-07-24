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
       <a data-toggle="modal" data-target="#CadP">
        <span class="info-box-icon btn-primary">
         <i class="fa fa-plus"></i>
        </span>
       </a>
       <div class="info-box-content"><br /><h4>Novo Projeto</h4>
      </div>
     </div>
    </div>
     <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
       <a data-toggle="modal" data-target="#Stats">
        <span class="info-box-icon btn-primary">
         <i class="fa fa-desktop"></i>
        </span>
       </a>
       <div class="info-box-content"><br /><h4>Estatísticas</h4>
      </div>
     </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
     <div class="info-box"><br />
      <img class="img-responsive pull-center" src="../dist/img/logo/ICLogo_Azul_GrafEsp.png" width="300">
     </div>
    </div>
    <div class="col-md-12 col-sm-6 col-xs-12">
     <div class="info-box"><br />
      <div class="nav-tabs-custom">
       <ul class="nav nav-tabs pull-right">
        <li class="active"><a href="#Ativos" data-toggle="tab">Projetos <strong>Enviados/Pendentes</strong></a></li>
        <li>
          <span data-toggle="modal" data-target="#Rel" class="btn btn-danger btn-sm">
           <i class="fa fa-get-pocket"> Gerar Relatório</i>
          </span>
        </li>
        <li class="pull-left header">Projetos do Distrito <?php echo $Distrito; ?></li>
       </ul>
       <div class="tab-content">
        <div class="tab-pane active" id="Ativos">
        <!-- AQUI COMEÇA TABELA COM PROJETOS QUE AINDA ESTÃO PENDENTES -->
         <table id="projetos" class="table table-bordered table-striped table-responsive">
          <thead>
           <tr>
            <th>ID</th>
            <th>Clube</th>
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
           echo "<td>Interact Club de " . $pAtivo['pro_ClubNome'] . "</td>";
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
        <!-- AQUI TERMINA A TABELA COM PROJETOS PENDENTES -->
        </div>

<!-- CAMPO DE MODALS
NOME DOS MODALS:
CadP - Cadastro de Projeto
Stats - Estatísticas
Rel - Relatórios
-->
        <div class="modal fade" id="CadP" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
          <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <code><span aria-hidden="true">&times;</span></code>
            </button>
            <h4 class="modal-title" id="myModalLabel">ADICIONAR NOVO PROJETO</h4>
           </div>
           <div class="modal-body">
            <form name="CadProjeto" id="CadProjeto" method="post" action="" enctype="multipart/form-data">
             <div class="col-xs-3">ID do projeto
              <input type="text" class="form-control" disabled placeholder="<?php echo $IDP; ?>">
             </div>
             <div class="col-xs-3">Data de Cadastro
              <input type="text" class="form-control" disabled placeholder="<?php echo $DtCad; ?>">
             </div>
             <div class="col-xs-6">Avenida
              <select class="form-control" name="avenida" id="avenida" required="required">
               <option value="" selected="selected">SELECIONE</option>
               <option value="INTERNOS">Internos</option>
               <option value="COMUNIDADES">Comunidades</option>
               <option value="FINANCAS">Finanças</option>
               <option value="IMAGEM PUBLICA">Imagem Pública</option>
              </select>
             </div>
             <div class="col-xs-12">Nome do Projeto
              <input type="text" id="nome" name="nome" class="form-control" required="required">
             </div>
             <div class="col-xs-7">Interact Club de:
              <select class="form-control" name="clube" id="clube" required="required">
               <option value="" selected="selected">SELECIONE</option>
                <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
               <option value="<?php echo $user['icbr_id'] ?>"><?php echo $user['icbr_Clube'] ?></option>
                <?php endwhile; ?>
              </select>
             </div>
             <div class="col-xs-5">Andamento do Projeto
              <select class="form-control" name="andamento" id="andamento" required="required">
               <option value="" selected="selected">SELECIONE</option>
               <option value="planejamento">Em Planejamento</option>
               <option value="execucao">Em Execução</option>
               <option value="finalizado">Finalizado</option>
              </select>
             </div>
             <div class="col-xs-12">Selecionar Arquivo
              <input type="file"   name="Arquivo" id="Arquivo"  />
             </div>
             <div class="box-footer"><br /></div><!-- /.box-footer -->
             <div class="modal-footer">
              <div>
               <input name="enviar" type="submit" class="btn btn-primary" id="enviar" value="Cadastrar Projeto" />
               <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
               </div>           
             </div>
            </form>
           </div>
           <?php
            if(@$_POST["enviar"]){
             $nome_temporario=$_FILES["Arquivo"]["tmp_name"];
             $nome_real=$_FILES["Arquivo"]["name"];
             $novonome = md5(mt_rand(1,10000).$nome_real['name']).'.pdf';
             $valor = "arquivo/" . $novonome;
             $upload = copy($nome_temporario,$valor);
              if($upload){
               echo '<script type="text/javascript">alert("Arquivo Enviado com Sucesso");</script>';
              }
              else{
               echo '<script type="text/javascript">alert("Não foi Possível enviar arquivo");</script>'; 
              }
             $Nome = $_POST['nome'];
             $Avenida = $_POST['avenida'];
             $Clube = $_POST['clube'];
             $Andamento = $_POST['andamento'];
    
             $chamaclube = $PDO->prepare("SELECT * FROM icbr_clube WHERE icbr_id='$Clube'");
             $chamaclube->execute();
              $iid = $chamaclube->fetch();
             $NomeClube = $iid['icbr_Clube'];
        
             $executa = $PDO->query("INSERT INTO icbr_projetos (pro_Nome, pro_ClubID, pro_ClubNome, pro_Avenida, pro_Distrito, pro_id, pro_Andamento, pro_DtCadastro, pro_FileNome) VALUES ('$Nome', '$Clube', '$NomeClube', '$Avenida', '$Distrito', '$IDP', '$Andamento', '$DtCad', '$novonome')");
             if($executa){
                  echo '
                 <script type="text/JavaScript">
                  alert("Cadastrado com sucesso!");
                  location.href="PROJETOS.php"
                 </script>';
             }
             else{
              echo '<script type="text/javascript">alert("Erro! <?php print_r($PDO->errorInfo()); ?>");</script>';
             }
            }
          ?>
          </div>
         </div>
        </div>
        <div class="modal fade" id="Rel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
          <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <code><span aria-hidden="true">&times;</span></code>
            </button>
            <h4 class="modal-title" id="myModalLabel">ADICIONAR NOVO PROJETO</h4>
           </div>
           <div class="modal-body">
              FORM DE CADASTRO DE PROJETO
           </div>
           <div class="modal-footer">
            <div>
             <input name="enviar" type="submit" class="btn btn-primary" id="enviar" value="Atualizar Foto" />
             <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            </div>
           </div>
          </div>
         </div>
        </div>
        <div class="modal fade" id="Stats" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
          <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <code><span aria-hidden="true">&times;</span></code>
            </button>
            <h4 class="modal-title" id="myModalLabel">Estatísticas</h4>
           </div>
           <div class="modal-body">
            <div class="col-xs-12"><strong>QUANTIDADE DE PROJETOS</strong><br />
              <?php
                // Dados do gráfico
                $tipo = 'p3';
                $largura = 400;
                $altura = 100;
                $dados = array(
                'Aprovados' => $QntAprovados,
                'Pendentes' => $QntPendentes
               );
               $labels = array_keys($dados);
               $valores = array_values($dados);
               $grafico = array(
               'cht' => $tipo,
               'chs' => $largura.'x'.$altura,
               'chd' => 't:'.implode(',', $valores),
               'chl' => implode('|', $labels)
               );
                $url = 'https://chart.googleapis.com/chart?'.http_build_query($grafico, '', '&amp;');
                printf('<img src="%s" width="%d" height="%d" alt="%s" />',
                $url, $largura, $altura, htmlentities('Gráfico de Exemplo', ENT_COMPAT, 'UTF-8'));
              ?>
            </div>
            <div class="modal-footer">
             <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            </div>
           </div>
          </div>
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
