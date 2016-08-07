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
  /* MARCADOR DE CAIXA DO DISTRITO
  Primeira Query:
  Chama os valores POSITIVOS para a gestão
  Segunda Query:
  Chama os valores POSITIVOS para a gestão
  $Valores: subtrai saídas por entradas
  $Contagem: transforma para padrão financeiro (de 210011 para R$2.100,11)
  */

  $ValoresPositivo = $PDO->query("SELECT SUM(tes_Valor) FROM icbr_tesouraria  WHERE tes_Distrito='$Distrito' AND tes_Gestao='$GVigente' AND tes_TipoOP='P'");
  $ValorP = $ValoresPositivo->fetchColumn();
  
  $ValoresNegativo = $PDO->query("SELECT SUM(tes_Valor) FROM icbr_tesouraria  WHERE tes_Distrito='$Distrito' AND tes_Gestao='$GVigente' AND tes_TipoOP='N'");
  $ValorN = $ValoresNegativo->fetchColumn();

  $Valores = $ValorP-$ValorN;

  $Contagem = 'R$' . number_format($Valores, 2, ',', '.'); // retorna R$100.000,50


$QueryClubes = "SELECT * FROM icbr_tesouraria WHERE tes_Distrito='$Distrito' AND tes_Gestao='$GVigente' ORDER BY icbr_tid ASC";
$stmt = $PDO->prepare($QueryClubes);
$stmt->execute();





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
            <li><a href="Clubes.php"><i class="fa fa-industry"></i> Clubes</a></li>
            <li><a href="Associados.php"><i class="fa fa-users"></i> Associados</a></li>
            <li><a href="Secretaria.php"><i class="fa fa-book"></i> Secretaria</a></li>
            <li class="active"><a href="Tesouraria.php"><i class="fa fa-dollar"></i> Tesouraria</a></li>
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
        Página Inicial
        <small>Distrito <?php echo $Distrito; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
        <li>Distrito <?php echo $Distrito; ?></li>
        <li class="active">Tesouraria</li>

      </ol>

    </section>
  <section class="content">
    <div class="row">
     <div class="col-md-4 col-sm-4 col-xs-12">
      <div class="info-box">
       <a data-toggle="modal" data-target="#NovoLancamento">
        <span class="info-box-icon btn-primary">
         <i class="fa fa-plus"></i>
        </span>
       </a>
       <div class="info-box-content"><br /><h4>Novo Lançamento</h4>
      </div>
     </div>
    </div>
     <div class="col-md-4 col-sm-4 col-xs-12">
      <div class="info-box">Saldo Atual:
       <?php
       if ($Valores >= 0) {
         echo '<span class="info-box-icon btn-success">';
         echo '<i class="glyphicon glyphicon-menu-up"></i>';
         echo '</span>';
         echo '<div class="info-box-content">';
         echo '<h3><p class="text-green">' . $Contagem . '</p></h3>';
       }
       else{
         echo '<span class="info-box-icon btn-danger">';
         echo '<i class="glyphicon glyphicon-menu-down"></i>';
         echo '</span>';
         echo '<div class="info-box-content">';
         echo '<h3><p class="text-red">' . $Contagem . '</p></h3>';       }
       ?>
      </div>
     </div>
    </div>

    <div class="col-md-4 col-sm-4 col-xs-12">
     <div class="info-box"><br />
      <img class="img-responsive pull-center" src="../dist/img/logo/ICLogo_Azul_GrafEsp.png" width="300">
     </div>
    </div>
    <div class="col-md-12 col-sm-6 col-xs-12">
     <div class="info-box"><br />
      <div class="nav-tabs-custom">
       <ul class="nav nav-tabs pull-right">
        <li class="active">
         <a href="#Ativos" data-toggle="tab">Movimentação Financeira</a>
        </li>
        <li>
          <span data-toggle="modal" data-target="#GeraRelatorio" class="btn btn-danger btn-sm">
           <i class="fa fa-get-pocket"> Gerar Relatório</i>
          </span>
        </li>
       </ul>
       <div class="tab-content">
        <div class="tab-pane active" id="Ativos">
        <table id="AAtivo" class="table table-bordered table-striped table-responsive">
         <thead>
          <tr>
           <th>ID</th>
           <th>Descrição</th>
           <th>Tipo</th>
           <th>Data de Movimentação</th>
           <th>Valor</th>
           <th></th>
          </tr>
         </thead>
         <tbody>
           <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)): 
           echo '<tr>';
           echo '<td>' . $user['icbr_tid'] . '</td>';
           echo '<td>' . $user['tes_Descreve'] . '</td>';
            $TipoOperacao = $user['tes_TipoOp'];
            $IDComprovante = $user['icbr_tid'];
            if ($TipoOperacao == 'P') {
             echo '<td>';
             echo '<button class="btn btn-success btn-xs btn-block disabled">ENTRADA</button>';
             echo '</td>';
            }
            elseif ($TipoOperacao == 'N') {
             echo '<td>';
             echo '<button class="btn btn-danger btn-xs btn-block disabled">Saída</button>';
             echo '</td>';            
            }
            else{
              #Nada Aqui
            }
           echo '<td>' . $user['tes_DtMovimento'] . '</td>';
           echo '<td><strong>R$</strong>';
           echo '<code>' . number_format($user['tes_Valor'], 2, ',', '.') . '<code>';
           echo '</td>';
           ?>         
           <td>
             <span class="btn bg-navy btn-xs btn-block" onclick="window.open('VerComprovante.php?ID=<?php echo $IDComprovante; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=800, HEIGHT=650');"><i class="fa fa-search"></i></span>
           </td>          
          </tr>
           <?php endwhile; ?>
         </tbody>
        </table>
        </div>

        <!-- MODAL DE GERAR RELATORIO -->
        <div class="modal fade" id="GeraRelatorio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
          <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <code><span aria-hidden="true">&times;</span></code>
            </button>
            <h4 class="modal-title" id="myModalLabel">Relatório de movimentação</h4>
           </div>
           <div class="modal-body">
              EM BREVE
           </div>
           <div class="modal-footer"></div>
          </div>
         </div>
        </div>
        <!-- FIM DO MODAL DE GERAR RELATÓRIO -->
        <!-- MODAL DE INSERIR LANÇAMENTO -->

  <div class="modal fade" id="NovoLancamento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
    <div class="modal-content">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <code><span aria-hidden="true">&times;</span></code>
      </button>
      <h4 class="modal-title" id="myModalLabel">Adicionando Movimento de caixa</h4>
     </div>
     <div class="modal-body">
      <div class="col-xs-12">
       <form name="despesa" id="despesa" method="post" action="" enctype="multipart/form-data">
        <div class="col-xs-4">Data de Movimentação
         <div class="input-group">
          <div class="input-group-addon">
           <i class="fa fa-calendar"></i>
          </div>
          <input type="text" name="data" class="form-control" minlength="10" maxlength="10" OnKeyPress="formatar('##/##/####', this)" required="required">
         </div>
        </div>
        <div class="col-xs-4">Valor
         <div class="input-group">
          <span class="input-group-addon">$</span>
          <input type="text" name="valor" required="required" class="form-control">
         </div>
        </div>
        <div class="col-xs-4">Gestão
         <select class="form-control" name="gestao" id="gestao" required="required">
          <option value="" selected="selected">SELECIONE</option>
          <option value="1617">2016/17</option>
         </select>
        </div>
        <div class="col-xs-12">Descrição da Movimentação
          <input type="text" name="descreve" required="required" class="form-control">
        </div>
        <div class="col-xs-7">Selecionar Arquivo
          <input type="file"   name="Arquivo" id="Arquivo" />
        </div>
        <div class="col-xs-5">Tipo de Operação
         <select class="form-control" name="operacao" id="operacao" required="required">
          <option value="" selected="selected">SELECIONE</option>
          <option value="P">Entrada</option>
          <option value="N">Saída</option>
         </select>
        </div>
        <br /><br /><br /><br /><br /><br /><br />
        <div>
        <br />
         <input name="enviar" type="submit" class="btn btn-primary" id="enviar" value="Cadastrar" />
         <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        </div>
       </form>
       <?php
       if(@$_POST["enviar"])
       {

          $nome_temporario=$_FILES["Arquivo"]["tmp_name"];
          $nome_real=$_FILES["Arquivo"]["name"];
          $novonome = md5(mt_rand(1,10000).$nome_real["name"]).'.jpg';
          $valor = "tesouraria/" . $novonome;
          $upload = copy($nome_temporario,$valor);
          $DataCadastro = date('d/m/Y h:i:s');
          $DataDespesa = $_POST['data'];
          $valor = $_POST['valor'];
            $pontos = '.';
            $virgula = ',';
            $result = str_replace($pontos, "", $valor);
            $ValorDespesa = str_replace($virgula, ".", $result);
          $GestaoDespesa = $_POST['gestao'];
          $DescreveDespesa = $_POST['descreve'];
          $TipoDespesa = $_POST['operacao'];
          $InserirDespesa = $PDO->query("INSERT INTO icbr_tesouraria (tes_Distrito, tes_Gestao, tes_Descreve, tes_TipoOp, tes_DtMovimento, tes_Valor, tes_DtCadastro, tes_FotoComprovante) VALUES ('$Distrito', '$GestaoDespesa', '$DescreveDespesa', '$TipoDespesa', '$DataDespesa', '$ValorDespesa', '$DataCadastro', '$novonome')");
              if ($InserirDespesa) 
              {
                  echo '
                 <script type="text/JavaScript">
                  alert("Movimento Cadastrado com Sucesso!");
                  location.href="Tesouraria.php"
                 </script>';              }
              else{
              echo '<script type="text/javascript">alert("Erro! ' . $PDO->errorInfo() . '");</script>';
              }
        }
       ?>




            </div>
           </div>
           <div class="modal-footer"></div>
          </div>
         </div>
        </div>




        <!-- FIM DO MODAL DE INSERIR LANÇAMENTO -->


            <!-- /.tab-content -->
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
<script type="text/javascript" src="formatar_moeda.js"></script>

<script>
      $(function () {
        $('#AInativo').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
        $('#AAtivo').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
      });
    </script>

<script>
function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }
  
}
</script>
</body>
</html>
