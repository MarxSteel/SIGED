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


$DataCadastro = date("d/m/Y - h:i:s");
$IDClube = $_GET['ID'];

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
          <li><a href="#">Clubes do Distrito</a></li>
          <li class="active">Inativar Clube</li>
        </ol>
      </section>
      <!-- Main content -->
   <section class="content">
    <div class="callout callout-warning">
          <h4>Atenção!</h4>

          <p>Você está prestes a Desativar este associado</p>
    </div>
    <div class="box box-default">
     <div class="box-header with-border">
      <h2 class="box-title">Interact Club de <?php echo $NomeClube; ?></h2>          
      <small class="pull-right"><strong>Distrito <?php echo $DistritoClube; ?></strong></small>
     </div>
     <div class="box-body">
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
       <div class="col-sm-5 invoice-col">
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
       <div class="col-sm-3 invoice-col">
        <address>
         <?php
          function qrcode($url, $size){
          if($url != "" && $size != ""){
          return "http://chart.apis.google.com/chart?cht=qr&chl=".$url."&chs=150x150";
             }
            }
         ?>
         <img src="<?php echo qrcode("http://interactbrasil.org/clubes/VerClube.php?ID=<?php echo $IDClube; ?>","200"); ?>" />
        </address>
       </div>
       <div class="col-sm-12 invoice-col">
        <form name="inativaClub" id="name" method="post" action="" enctype="multipart/form-data">
         <div>
          <input name="enviar" type="submit" class="btn bg-red btn-lg btn-block" id="enviar" value="Desativar Clube" />
         </div>
        </form>
        <?php
         if(@$_POST["enviar"])
           {
            $executa = $PDO->query("UPDATE icbr_clube SET icbr_Status='D' WHERE icbr_id='$IDClube' ");
             if($executa)
               {
                echo '<script type="text/javascript">alert("Clube Desativado. Agora Inativaremos Associados");</script>';
                $executa2 = $PDO->query("UPDATE icbr_associado SET icbr_AssStatus='I' WHERE icbr_AssClubeID='$IDClube'");
                 if ($executa2)
                  {
                    echo '<script type="text/javascript">alert("Associados Inativados");</script>';
                    echo '<script type="text/javascript">window.close();</script>';
                  }
                  else
                  {
                    echo '<script type="text/javascript">alert("Não foi possível Inativar os Associados");</script>';
                  }
               }
               else
               {
                echo '<script type="text/javascript">alert("! <?php print_r($PDO->errorInfo()); ?>");</script>';
               }
              }
             ?>





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
