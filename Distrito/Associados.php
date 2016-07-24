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

$AssociadosGeral = "SELECT COUNT(*) AS total FROM icbr_associado WHERE icbr_AssDistrito='4730'";
$stmt_count = $PDO->prepare($AssociadosGeral);
$stmt_count->execute();
$VlrGeral = $stmt_count->fetchColumn();
//FINAL: CONTANDO A QUANTIDADE GERAL DE ASSOCIADOS
//INICIO: CONTANDO A QUANTIDADE DE ASSOCIADOS FEMININO
$AssociadosF = "SELECT COUNT(*) AS total FROM icbr_associado WHERE icbr_AssDistrito='4730' AND icbr_AssGenero='F'";
$stmt_count2 = $PDO->prepare($AssociadosF);
$stmt_count2->execute();
$AssF = $stmt_count2->fetchColumn();
//FINAL: CONTANDO A QUANTIDADE DE ASSOCIADOS FEMININO
//INICIO: CONTANDO A QUANTIDADE DE ASSOCIADOS MASCULINO
$AssociadosM = "SELECT COUNT(*) AS total FROM icbr_associado WHERE icbr_AssDistrito='4730' AND icbr_AssGenero='M'";
$stmt_count3 = $PDO->prepare($AssociadosM);
$stmt_count3->execute();
$AssM = $stmt_count3->fetchColumn();
//FINAL: CONTANDO A QUANTIDADE DE ASSOCIADOS MASCULINO
//INICIO: CONTAGEM DE INTERACTIANOS ENTRE 12 E 13:
$Idade12 = "SELECT COUNT(*) AS total FROM icbr_associado WHERE  icbr_AssIdade  BETWEEN '12' AND '13' AND  icbr_AssDistrito='4730'";
$stmt_count4 = $PDO->prepare($Idade12);
$stmt_count4->execute();
$VIdade12 = $stmt_count4->fetchColumn();
//FINAL: CONTAGEM DE INTERACTIANOS ENTRE 12 E 13
//INICIO: CONTAGEM DE INTERACTIANOS ENTRE 14 E 15:
$Idade14 = "SELECT COUNT(*) AS total FROM icbr_associado WHERE  icbr_AssIdade  BETWEEN '14' AND '15' AND  icbr_AssDistrito='4730'";
$stmt_count5 = $PDO->prepare($Idade14);
$stmt_count5->execute();
$VIdade14 = $stmt_count5->fetchColumn();
//FINAL: CONTAGEM DE INTERACTIANOS ENTRE 14 E 15
//INICIO: CONTAGEM DE INTERACTIANOS ENTRE 16 E 18:
$Idade16 = "SELECT COUNT(*) AS total FROM icbr_associado WHERE  icbr_AssIdade  BETWEEN '16' AND '18' AND  icbr_AssDistrito='4730'";
$stmt_count6 = $PDO->prepare($Idade16);
$stmt_count6->execute();
$VIdade16 = $stmt_count6->fetchColumn();
//FINAL: CONTAGEM DE INTERACTIANOS ENTRE 16 E 18
$IdadeGeral = $VIdade12+$VIdade14+$VIdade16;

// AQUI DECLARO A QUERY DE DADOS DOS CLUBES:
$QueryClubes = "SELECT icbr_uid, icbr_AssClube, icbr_AssNome, icbr_AssCargo, icbr_AssDtNascimento FROM icbr_associado WHERE icbr_AssDistrito='$Distrito' AND icbr_AssStatus='A' ORDER BY icbr_AssNome ASC";
$stmt = $PDO->prepare($QueryClubes);
$stmt->execute();

//CHAMANDO OS ASSOCIADOS INATIVOS
$QueryClubes2 = "SELECT icbr_uid, icbr_AssClube, icbr_AssNome, icbr_AssCargo, icbr_AssDtNascimento FROM icbr_associado WHERE icbr_AssDistrito='$Distrito' AND icbr_AssStatus='I' ORDER BY icbr_AssNome ASC";
$stmt2 = $PDO->prepare($QueryClubes2);
$stmt2->execute();

$QueryClubes3 = "SELECT * FROM icbr_clube WHERE icbr_Status='A' AND icbr_Distrito='$Distrito'";
// seleciona os registros
$stmt3 = $PDO->prepare($QueryClubes3);
$stmt3->execute();
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
       <a data-toggle="modal" data-target="#NovoSocio">
        <span class="info-box-icon btn-primary">
         <i class="fa fa-plus"></i>
        </span>
       </a>
       <div class="info-box-content"><br /><h4>Adicionar Associado</h4>
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
        <li class="active"><a href="#Ativos" data-toggle="tab">Associados ativos</a></li>
        <li><a href="#Inativos" data-toggle="tab">Associados Desligados</a></li>
        <li class="pull-left header">LISTA DE CLUBS</li>
       </ul>
       <div class="tab-content">
        <div class="tab-pane active" id="Ativos">
        <table id="AAtivo" class="table table-bordered table-striped table-responsive">
         <thead>
          <tr>
           <th>ID</th>
           <th>Interact Clube de</th>
           <th>Nome</th>
           <th>Data de Nascimento</th>
           <th>Cargo</th>
           <th></th>
          </tr>
         </thead>
         <tbody>
          <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
          <tr>
           <td><?php echo $user['icbr_uid'] ?></td>
           <td><?php echo $user['icbr_AssClube'] ?></td>
           <td><?php echo $user['icbr_AssNome'] ?></td>
           <td><?php echo $user['icbr_AssDtNascimento'] ?></td>
           <td><?php echo $user['icbr_AssCargo'] ?></td>
           <td>
            <a href='VerSocio.php?ID=<?php echo $user['icbr_uid'] ?>' class="btn btn-default btn-sm" target="_blank"><i class="fa fa-search"></i></a>
            <span class="btn btn-danger btn-sm" onclick="window.open('DesativaAssociado.php?ID=<?php echo $user['icbr_uid'] ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=800, HEIGHT=650');"><i class="fa fa-remove"></i> </span>
           </td>
          </tr>
          <?php endwhile; ?>
         </tbody>
        </table>
        </div>
        <div class="tab-pane" id="Inativos">
        <table id="AInativo" class="table table-bordered table-striped table-responsive">
         <thead>
          <tr>
           <th>ID</th>
           <th>Interact Clube de</th>
           <th>Nome</th>
           <th>Data de Nascimento</th>
           <th>Cargo</th>
           <th></th>
          </tr>
         </thead>
         <tbody>
          <?php while ($user2 = $stmt2->fetch(PDO::FETCH_ASSOC)): ?>
          <tr>
           <td><?php echo $user2['icbr_uid'] ?></td>
           <td><?php echo $user2['icbr_AssClube'] ?></td>
           <td><?php echo $user2['icbr_AssNome'] ?></td>
           <td><?php echo $user2['icbr_AssDtNascimento'] ?></td>
           <td><?php echo $user2['icbr_AssCargo'] ?></td>
           <td>
            <a href='VerSocio.php?ID=<?php echo $user2['icbr_uid'] ?>' class="btn btn-default btn-sm" target="_blank"><i class="fa fa-search"></i></a>
            <span class="btn btn-success btn-sm" onclick="window.open('AtivaAssociado.php?ID=<?php echo $user2['icbr_uid'] ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=800, HEIGHT=650');"><i class="fa fa-check-circle"></i> 
            </span>
           </td>
          </tr>
          <?php endwhile; ?>
         </tbody>
        </table>
        </div>
        <div class="modal fade" id="NovoSocio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
     <form onsubmit="return valida_form();" name="cadastrar_anuncio" id="name" method="post" action="" enctype="
     multipart/form-data">
      <div class="col-xs-10">Nome Completo
       <input type="text" id="nome" name="nome" class="form-control" required="required">
      </div>
      <div class="col-xs-2">idade
       <input type="text" id="idade" name="idade" class="form-control" required="required">
      </div>
      <div class="col-xs-6">Interact Club de:
       <select class="form-control" name="clube" id="clube" required="required">
        <option value="" selected="selected">SELECIONE</option>
            <?php while ($user3 = $stmt3->fetch(PDO::FETCH_ASSOC)): ?>
            <option value="<?php echo $user3['icbr_id'] ?>"><?php echo $user3['icbr_Clube'] ?></option>
            <?php endwhile; ?>
       </select>
      </div>
      <div class="col-xs-6">Cargo
       <select class="form-control" name="cargo" id="cargo" required="required">
        <option value="" selected="selected">SELECIONE</option>
        <option value="Presidente">Presidente</option>
        <option value="Secretario">Secretário</option>
        <option value="2º Secretário">2º Secretário</option>
        <option value="Tesoureiro">Tesoureiro</option>
        <option value="2º Tesoureiro">2º Tesoureiro</option>
        <option value="Diretor de Finanças">Diretor de Finanças</option>
        <option value="Diretor de Internos">Diretor de Internos</option>
        <option value="Diretor de Comunidades">Diretor de Comunidades</option>
        <option value="Diretor de Imagem Publica">Diretor de Imagem Pública</option>
        <option value="Diretor">Diretor</option>
        <option value="Associado">Associado</option>
       </select>
      </div>
      <div class="col-xs-4">Data de Posse
       <input type="text" id="posse" name="posse" class="form-control" required="required" minlength="10" maxlength="10" placeholder="Formato DD/MM/AAAA">
      </div>
      <div class="col-xs-4">Data de Nascimento
       <input type="text" id="nasc" name="nasc" class="form-control" required="required" minlength="10" maxlength="10" placeholder="Formato DD/MM/AAAA">
      </div>
      <div class="col-xs-4">Gênero
       <select class="form-control" name="genero" id="genero" required="required">
        <option value="" selected="selected">SELECIONE</option>
        <option value="M">Masculino</option>
        <option value="F">Feminino</option>
       </select>
      </div>
      <br /><h4>Dados de Endereço</h4>
      <div class="col-xs-9">Rua
       <input type="text" id="rua" name="rua" class="form-control" required="required" >
      </div>
      <div class="col-xs-3">Nº
       <input type="text" id="numero" name="numero" class="form-control" required="required"  >
      </div>
      <div class="col-xs-6">Bairro/Setor
       <input type="text" id="bairro" name="bairro" class="form-control" required="required"  >
      </div>
      <div class="col-xs-6">Cidade
       <input type="text" id="cidade" name="cidade" class="form-control" required="required"  >
      </div>
      <div class="col-xs-4">CEP
       <input type="text" id="cep" name="cep" minlength="10" maxlength="10"  class="form-control" required="required"  >
      </div>
      <div class="col-xs-4">Estado
       <select class="form-control" name="uf" id="uf" required="required">
        <option value="" selected="selected">SELECIONE</option>
        <option value="Acre">Acre</option>
        <option value="Alagoas">Alagoas</option>
        <option value="Amapá">Amapá</option>
        <option value="Amazonas">Amazonas</option>
        <option value="Bahia">Bahia</option>
        <option value="Ceará">Ceará</option>
        <option value="Distrito Federal">Distrito Federal</option>
        <option value="Espirito Santo">Espírito Santo</option>
        <option value="Goiás">Goiás</option>
        <option value="Maranhão">Maranhão</option>
        <option value="Mato Grosso">Mato Grosso</option>
        <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
        <option value="Minas Gerais">Minas Gerais</option>
        <option value="Pará">Pará</option>
        <option value="Paraíba">Paraíba</option>
        <option value="Paraná">Paraná</option>
        <option value="Pernambuco">Pernambuco</option>
        <option value="Piauí">Piauí</option>
        <option value="Rio de Janeiro">Rio de Janeiro</option>
        <option value="Rio Grande do Norte">Rio Grande do Norte</option>
        <option value="Rio Grande do Sul">Rio Grande do Sul</option>
        <option value="Rondônia">Rondônia</option>
        <option value="Roraima">Roraima</option>
        <option value="Santa Catarina">Santa Catarina</option>
        <option value="São Paulo">São Paulo</option>
        <option value="Sergipe">Sergipe</option>
        <option value="Tocantins">Tocantins</option>
       </select>
      </div>
      <div class="col-xs-4"><br /></div><br />
             <div>
               <br /><br />
               <input name="enviar" type="submit" class="btn btn-primary" id="enviar" value="Cadastrar" />
               <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
              </div>
     </form>
        <?php
        if(@$_POST["enviar"])
         {
          $Nome = $_POST['nome'];
          $Clube = $_POST['clube'];
          $Cargo = $_POST['cargo'];
          $Posse = $_POST['posse'];
          $Idade = $_POST['idade'];
          $DtNasc = $_POST['nasc'];
          $Rua = $_POST['rua'];
          $Num = $_POST['numero'];
          $Bairro = $_POST['bairro'];
          $Cidade = $_POST['cidade'];
          $UF = $_POST['uf'];
          $CEP = $_POST['cep'];
          $G = $_POST['genero'];

$uploaddir = 'pasta/';

$uploadfile = $uploaddir . $_FILES['arquivo']['name'];

if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile)){
echo "Arquivo Enviado";}
else {echo "Arquivo não enviado";}

         $chamaclube = $PDO->prepare("SELECT * FROM icbr_clube WHERE icbr_id='$Clube'");
      $chamaclube->execute();

          $iid = $chamaclube->fetch();
            $NomeClube = $iid['icbr_Clube'];

   $executa = $PDO->query("INSERT INTO icbr_associado (icbr_AssNome, icbr_DtPosse, icbr_AssCargo, icbr_AssClube, icbr_AssClubeID, icbr_AssDistrito, icbr_AssDtNascimento, icbr_AssIdade, icbr_AssEndereco, icbr_AssNum, icbr_AssBairro, icbr_AssCidade, icbr_AssUF, icbr_AssCEP, icbr_AssGenero, icbr_AssFoto) VALUES ('$Nome', '$Posse', '$Cargo', '$NomeClube', '$Clube', '$Distrito', '$DtNasc', '$Idade', '$Rua', '$Num', '$Bairro', '$Cidade', '$UF', '$CEP', '$G', 'SemFoto.jpg')");
   if($executa){
                  echo '
                 <script type="text/JavaScript">
                  alert("Associado cadastrado com sucesso!");
                  location.href="Associados.php"
                 </script>';
   }
   else{
      echo '<script type="text/javascript">alert("Erro! <?php print_r($PDO->errorInfo()); ?>");</script>';

   }
         }
        ?>

          
            </div>
           </div>
           <div class="modal-footer"></div>
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
            <h4 class="modal-title" id="myModalLabel">Meu Distrito em Números</h4>
           </div>
           <div class="modal-body">
            <div class="col-xs-6">
             <div class="box box-primary">
              <div class="box-header with-border">
               <h3 class="box-title">Faixa Etária</h3>
              </div>
              <div class="box-body">
               <li class="list-group-item">
                12-13 Anos
                <a class="pull-right">
                 <?php echo $VIdade12; ?>
                 <code>
                   (<?php echo (($VIdade12 / $IdadeGeral)*100); ?>%)
                 </code>
                </a>
               </li>
               <li class="list-group-item">
                 14-15 Anos
                 <a class="pull-right">
                  <?php echo $VIdade14; ?>
                  <code>
                    (<?php echo (($VIdade14 / $IdadeGeral)*100); ?>%)
                  </code>
                 </a>
               </li>
               <li class="list-group-item">
                 16-18 Anos
                 <a class="pull-right">
                  <?php echo $VIdade16; ?>
                  <code>
                    (<?php echo (($VIdade16 / $IdadeGeral)*100); ?>%)
                  </code>
                 </a>
               </li>
              </div>
             </div>
           </div>
            <div class="col-xs-6">
             <div class="box box-primary">
              <div class="box-header with-border">
               <h3 class="box-title">Gênero</h3>
              </div>
              <div class="box-body">
               <li class="list-group-item">
                Masculino
                <a class="pull-right">
                 <?php echo $AssF; ?>
                  <code>
                   (<?php echo (($AssF / $VlrGeral)*100); ?>%)
                 </code>
                </a>
               </li>
               <li class="list-group-item">
               .
               </li>
               <li class="list-group-item">
                 16-18 Anos
                 <a class="pull-right">
                 <?php echo $AssM; ?>
                  <code>
                   (<?php echo (($AssM / $VlrGeral)*100); ?>%)
                 </code>
                 </a>
               </li>
              </div>
             </div>
           </div>
           <div class="modal-footer"></div>
          </div>
         </div>
        </div>
              <!-- /.tab-pane -->
              <!-- /.tab-pane -->
            </div>
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
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Idade', 'Quantidade'],
          ['12 a 13 Anos',     <?php echo $VIdade12; ?>],
          ['14 a 15 Anos',      <?php echo $VIdade14; ?>],
          ['16 a 18 Anos', <?php echo $VIdade16; ?>]
        ]);

        var options = {
          title: '',
          pieHole: 0,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>

</body>
</html>
