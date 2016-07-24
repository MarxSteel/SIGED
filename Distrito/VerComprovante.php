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

$IDCOMP = $_GET['ID'];
$dadosclube = $PDO->prepare("SELECT * FROM icbr_tesouraria WHERE icbr_tid='$IDCOMP'");
      $dadosclube->execute();
      $campo = $dadosclube->fetch();
      $DespTipo = $campo['tes_TipoOp'];
       if ($DespTipo == 'P') {
        $DTipo = '<button class="btn btn-success btn-xs btn-block">ENTRADA</button>';
       }
       elseif ($DespTipo == 'N') {
        $DTipo = '<button class="btn btn-danger btn-xs btn-block">SAÍDA</button>';
       }

     $DespValor = $campo['tes_Valor'];
        $FValor = number_format($DespValor, 2, ',', '.'); // retorna R$100.000,50
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
 <div class="wrapper">
  <header class="main-header">
   <nav class="navbar navbar-static-top">
    <div class="container">
     <div class="navbar-header">
      <span class="logo-lg">
       <img src="../dist/img/logo/ICLogo.png" width="200">
      </span>
     </div>

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
</div>
      </div>
    </nav>
  </header>
  <div class="content-wrapper">
    <div class="container">
      <section class="content-header">
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
          <li><a href="#">Meu Distrito</a></li>
          <li><a href="#">Tesouraria</a></li>
          <li class="active">Visualizar Comprovante</li>
        </ol>
      </section>
      <!-- Main content -->
   <section class="content">
    <div class="box box-default">
     <div class="box-header with-border">
      <h2 class="box-title"><?php echo $campo['tes_Descreve']; ?></h2>          
     </div>
     <div class="box-body">
     <?php 
     echo '<div class="row invoice-info">';
     echo '<div class="col-sm-6 invoice-col">';
     echo '<address>';
     echo '<strong>Valor:</strong><br />';
     echo '<strong>R$</strong>' . $FValor . '<br /><br />';
     echo '<strong>Tipo:</strong><br />';
     echo $DTipo;
     echo '<strong>Data de Cadastro: </strong><br />';
     echo $campo["tes_DtCadastro"] . '<br /><br />';
     echo '<strong>Data de Lançamento: </strong><br />';
     echo $campo["tes_DtMovimento"] . '<br /><br />';
     echo '</address>';
     echo '</div>';

     ?>
       <div class="col-sm-6 invoice-col">
       <img src="tesouraria/<?php echo $campo['tes_FotoComprovante']; ?>" width="200">

       </div>
       <div class="col-sm-12 invoice-col">
      
       </div>
      </div>
     </div>
    </div>
   </section>
  </div>
 </div>
<?php include_once '../footer.php'; ?>
</div>
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../plugins/fastclick/fastclick.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/demo.js"></script>
</body>
</html>
